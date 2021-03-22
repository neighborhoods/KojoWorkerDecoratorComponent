# Kōjō Worker Decorators

A set of useful decorators for a typical [Kōjō](https://github.com/neighborhoods/kojo) Worker.

## Technical Design Artifacts

[Runtime Schematics](https://drive.google.com/file/d/1lLQck0XMuAYdVEGzQB01sgJUm8WNa1jg)

## Install

Via Composer

``` bash
$ composer require neighborhoods/kojo-worker-decorator-component
```

## Predefined decorators

* [Exception Handling Decorator](#exception-handling-decorator)
* [Crashed Threshold Decorator](#crashed-threshold-decorator)
* [Retry Threshold Decorator](#retry-threshold-decorator)
* [Userland PDO Decorator](#userland-pdo-decorator)
* [Rescheduling Decorator](#rescheduling-decorator)

All decorators use Buphalo decorator templates.

### Exception Handling Decorator

This decorator handles exceptions thrown by the decorated worker.  
It prevents jobs from panicking. In case of a transient fault, the job is retried after a predefined interval. In case of a non-transient fault the job is held. Either way the exception is logged.

When defining the decorator stack (in the worker builder's service definition/YAML file), make sure the exception handling decorator is listed last.

This decorator is compatible with [Exception Component](https://github.com/neighborhoods/ExceptionComponent) and [Throwable Diagnostic Component](https://github.com/neighborhoods/ThrowableDiagnosticComponent) when it comes to determining the transiency of an exception.

If a job panics, although the worker is decorated with the exception handling decorator, it means that an exception occurred before the decorator is invoked. If the Proxy template is used with the exception handling decorator being the last in the decorator stack, a job can only panic if there's a problem with building the container.  
This is most likely cause by a missing environment variable or invalid value.

#### Parameters

 * **retryIntervalDefinition**  
   Type: string  
   Default value: 1 minute  
   String representation of `DateInterval` by which retry is delayed after catching a transient exception.

### Crashed Threshold Decorator

This decorator prevents jobs from repeatedly crashing and defends against hysteresis.

A crash occurs when the worker doesn't gracefully exit, for example runs out of memory, segmentation fault, gets terminated due to a signal...

Kōjō attempts to rerun the job after the crash. This decorator detects that the job previously crashed and sleeps to prevent hysteresis.

The decorator holds the job when the number of crashes exceeds the threshold.

#### Parameters

 * **threshold**  
   Type: integer  
   Default value: 5
   Minimal allowed value: 1  
   Maximal number of crashes before holding the job.

 * **delaySeconds**  
   Type: integer  
   Default value: 1  
   Minimal allowed value: 1  
   Number of seconds by which execution is delayed after a crash.

### Retry Threshold Decorator

This decorator prevents jobs from repeatedly retrying.

The decorator holds the job when the number of retries exceeds the threshold.

#### Parameters

* **threshold**  
  Type: integer  
  Default value: 100  
  Minimal allowed value: 1  
  Maximal number of crashes before holding the job.

### Userland PDO Decorator

Configures Kōjō API Worker Service to use a specific connection, core by default.  
Knowing the connection enables worker logic to isolate job state changes into transactions.

#### Parameters

The decorator itself expects a connection. In practice the connection is obtained from a Prefab5 connection repository, which is done by the Userland PDO Decorator Builder.  
So the builder requires the connection id, which is injected using a Symfony DI parameter, and the Prefab5 connection repository, which is injected using a Symfony DI service.  
* **connectionId**  
  Type: string  
  Default value: core  
  ID of Prefab5 Doctrine DBAL connection to be used by the Kōjō API Worker Service.

The Prefab5 connection repository doesn't have a default value. The Symfony DI service `Vendor\Product\Prefab5\Doctrine\DBAL\Connection\Decorator\RepositoryInterface` has to be defined. The easiest way to do so is by defining it as an alias of the corresponding Prefab5 generated class.

### Rescheduling Decorator

This decorator is intended for jobs rescheduling themselves (observers). It completes the running job with success and schedules the next, possibly delayed. The completion and scheduling is atomic, since it's done in a transaction, which is why the decorator needs to know what connection is used by Kōjō.  
The decorator doesn't reschedule if the decorated worker has already applied a state change request, e.g. has held or has completed with success. If that is the case, the decorator logs a warning, which is why it's recommended to have this decorator at the top of the decorator stack (in the worker builder's service definition/YAML file).

#### Parameters

* **jobTypeCode**  
  Type: string  
  Job type code of the scheduled job. Doesn't have a default value and has to be provided.
  
* **rescheduleDelaySeconds**  
  Type: integer  
  Minimal allowed value: 0  
  Maximal allowed value: 86400 (24 hours)  
  Number of seconds between completing the current and starting the next job.

The decorator itself expects a connection. In practice the connection is obtained from a Prefab5 connection repository, which is done by the Rescheduling Decorator Builder.  
So the builder requires the Kōjō connection id, which is injected using a Symfony DI parameter, and the Prefab5 connection repository, which is injected using a Symfony DI service.
* **connectionId**  
  Type: string  
  Default value: core  
  ID of Prefab5 Doctrine DBAL connection used by the Kōjō API Worker Service. If the [Userland PDO Decorator](#userland-pdo-decorator) is used, the value has to match its connectionId parameter value.

The Prefab5 connection repository doesn't have a default value. The Symfony DI service `Vendor\Product\Prefab5\Doctrine\DBAL\Connection\Decorator\RepositoryInterface` has to be defined. The easiest way to do so is by defining it as an alias of the corresponding Prefab5 generated class.  
The same has to be done for [Userland PDO Decorator](#userland-pdo-decorator). There is no need to define the same alias twice, so it is enough to define it in one place.

## Usage

Kōjō doesn't enforce any interface to workers, but this component does. To decorate your worker it must implement the 
`Neighborhoods\KojoWorkerDecoratorComponent\WorkerInterface`. This can be easily done by using the `AwareTrait` for Kojo API Worker Service and Kojo API RDBMS Connection Service as shown below.

``` php
<?php
namespace Acme;

use Neighborhoods\Kojo\Api\V1;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerInterface;

class MyWorker implements WorkerInterface
{
    use V1\Worker\Service\AwareTrait;
    use V1\RDBMS\Connection\Service\AwareTrait;

    public function work(): WorkerInterface
    {
        // Do something

        return $this;
    }
}
```

### Proxy

The Worker will not be used by Kōjō directly. Kōjō will use a Proxy, which will build the Worker with the desired decorators.  
Kōjō will provide the Proxy with its API services, which are forwarded to the worker.  
The Proxy might use the [Neighborhoods Container Builder](https://github.com/neighborhoods/DependencyInjectionContainerBuilderComponent), as shown below, to obtain the builder for the worker and decorators. The decorators and worker can use dependency injection, while the Proxy cannot.

``` php
<?php
namespace Acme\MyWorker;

use Acme\MyWorker;
use Neighborhoods\DependencyInjectionContainerBuilderComponent\TinyContainerBuilder;
use Neighborhoods\Kojo\Api;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerInterface;
use Psr\Container\ContainerInterface;

class Proxy implements WorkerInterface
{
    use Api\V1\Worker\Service\AwareTrait;
    use Api\V1\RDBMS\Connection\Service\AwareTrait;

    public function work(): WorkerInterface
    {
        $worker = $this->getContainer()->get(MyWorker\Builder\FactoryInterface::class)
            ->create()
            ->setApiV1RDBMSConnectionService($this->getApiV1RDBMSConnectionService())
            ->setApiV1WorkerService($this->getApiV1WorkerService())
            ->build();

        $worker->work();

        return $this;
    }

    protected function getContainer(): ContainerInterface
    {
        $containerBuilder = new TinyContainerBuilder();
        // Container configuration
        $containerBuilder->makePublic(MyWorker\Builder\FactoryInterface::class);
        return $containerBuilder->build();
    }
}
```

The `MyWorker\Builder\FactoryInterface` should extend the `Neighborhoods\KojoWorkerDecoratorComponent\Worker\Builder\FactoryInterface`. That way the `create()` method will provide a builder which implements `Neighborhoods\KojoWorkerDecoratorComponent\Worker\BuilderInterface`, for example `Neighborhoods\KojoWorkerDecoratorComponent\Worker\Builder`.

If predefined decorators are used, make sure the container builder's discoverable directories include path filters to this component's source and fabrication folders.
``` php
// Discover KojoWorkerDecoratorComponent service definitions
$containerBuilder->getDiscoverableDirectories()->addDirectoryPathFilter(
    '../vendor/neighborhoods/kojo-worker-decorator-component/fab'
);
$containerBuilder->getDiscoverableDirectories()->addDirectoryPathFilter(
    '../vendor/neighborhoods/kojo-worker-decorator-component/src'
);
```

### Decorator stack

Configure the builder using Symfony DI to build a decorator stack tailored to your needs. The `ExceptionHandlingDecorator` should be the last in the list. An example is shown below.

``` yaml
# Acme\MyWorker\Builder.service.yml
services:
  Neighborhoods\KojoWorkerDecoratorComponent\Worker\BuilderInterface:
    class: Neighborhoods\KojoWorkerDecoratorComponent\Worker\Builder
    public: false
    shared: false
    calls:
      - [setWorkerFactory, ['@Acme\MyWorker\FactoryInterface']]
      # Add predefined and custom decorators
      - [addDecoratorBuilderFactory, ['@Neighborhoods\KojoWorkerDecoratorComponent\Worker\CrashedThresholdDecorator\Builder\FactoryInterface']]
      - [addDecoratorBuilderFactory, ['@Neighborhoods\KojoWorkerDecoratorComponent\Worker\UserlandPdoDecorator\Builder\FactoryInterface']]
      - [addDecoratorBuilderFactory, ['@Neighborhoods\KojoWorkerDecoratorComponent\Worker\ExceptionHandlingDecorator\Builder\FactoryInterface']]

```

Decorator parameters have default values when possible.  
The [Userland PDO Decorator](#userland-pdo-decorator) builder requires the `Vendor\Product\Prefab5\Doctrine\DBAL\Connection\Decorator\RepositoryInterface` service, which doesn't have a default value. How to define it is shown in an [example](https://github.com/neighborhoods/KojoWorkerDecoratorComponentFitness/blob/main/src/SuccessWorker/Worker/UserlandPdoDecorator/Builder.service.yml).  
The [Rescheduling Decorator](#rescheduling-decorator) is missing default values for jobTypeCode, rescheduleDelaySeconds and `Vendor\Product\Prefab5\Doctrine\DBAL\Connection\Decorator\RepositoryInterface` service. How to define them is shown in an [example](https://github.com/neighborhoods/KojoWorkerDecoratorComponentFitness/blob/main/src/ReschedulingDecorator/Worker/ReschedulingDecorator.service.yml).

Other decorator parameters are defined using DI parameters. The default parameter values can be overridden by redefining them. Make sure that the file containing the value you want to be applied is loaded last, i.e. load the service definitions from you project after service definitions from your dependencies.  
To avoid mixing worker builder and decorator definitions, provide them in separate yaml files. An [example](https://github.com/neighborhoods/KojoWorkerDecoratorComponentFitness/tree/main/src/DecoratorParameters/Worker) is available.

## Custom decorator

In addition to the decorators provided in this component, you may implement your own decorator(s).  
It has to extend the `Neighborhoods\KojoWorkerDecoratorComponent\Worker\DecoratorInterface` interface, which will be mostly implemented using the `Neighborhoods\KojoWorkerDecoratorComponent\Worker\DecoratorTrait` trait. The only method left to implement is the `work()` method, which at some point might run the decorated worker as shown below.
``` php
<?php

namespace Acme\MyWorker;

use Neighborhoods\KojoWorkerDecoratorComponent\Worker;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerInterface;

final class CustomDecorator implements Worker\DecoratorInterface
{
    use Worker\DecoratorTrait;

    public function work(): WorkerInterface
    {
        // Custom work method, possibly running decorated worker.
        $this->runWorker();

        return $this;
    }
}
```
The custom decorator may have additional dependencies, which can be injected using Symfony service definitions.

Create a builder and builder factory for the custom decorator by implementing the `Neighborhoods\KojoWorkerDecoratorComponent\Worker\Decorator\BuilderInterface` and `Neighborhoods\KojoWorkerDecoratorComponent\Worker\Decorator\Builder\FactoryInterface` interfaces respectively. After defining corresponding Symfony DI services, the builder factory for the custom decorator can be added to the worker builder (`Acme\MyWorker\Builder.service.yml` in given examples).

A full implementation of a custom decorator is provided in [this example](https://github.com/neighborhoods/KojoWorkerDecoratorComponentFitness/blob/main/src/CustomDecorator/Worker/CustomDecorator.php).

## Buphalo integration

[Buphalo](https://github.com/neighborhoods/Buphalo) templates are available for workers and custom decorators as well as their accompanying files.

### Prerequisites

The Buphalo templates are provided in a custom template tree. Support for multiple template trees has been added to Buphalo in version 1.1. Ensure you have Buphalo version 1.1 or above installed.  
When you run Buphalo you need to add the template tree contained in this package to the template tree directory paths. To do so make an export as shown below.
``` bash
Neighborhoods_Buphalo_V1_TemplateTree_Map_Builder_FactoryInterface__TemplateTreeDirectoryPaths=default:$PWD/vendor/neighborhoods/buphalo/template-tree/V1,diagnostic:$PWD/vendor/neighborhoods/kojo-worker-decorator-component/template-tree/V1
```

The export above assumes that you have no other custom template trees.

### Worker fabrication

Create the file `MyWorker.buphalo.v1.fabrication.yml` if it doesn't already exist and make sure it has the following lines.

``` yaml
actors:
  <PrimaryActorName>.php:
    template: KojoWorkerDecoratorComponent/Worker/PrimaryActorName.php
  <PrimaryActorName>.service.yml:
    template: PrimaryActorName.service.yml
  <PrimaryActorName>Interface.php:
    template: KojoWorkerDecoratorComponent/Worker/PrimaryActorNameInterface.php
  <PrimaryActorName>/AwareTrait.php:
    template: PrimaryActorName/AwareTrait.php
  <PrimaryActorName>/Proxy.php:
    template: KojoWorkerDecoratorComponent/Worker/PrimaryActorName/Proxy.php
  <PrimaryActorName>/Proxy.service.yml:
    template: KojoWorkerDecoratorComponent/Worker/PrimaryActorName/Proxy.service.yml
  <PrimaryActorName>/ProxyInterface.php:
    template: KojoWorkerDecoratorComponent/Worker/PrimaryActorName/ProxyInterface.php
  <PrimaryActorName>/Proxy/AwareTrait.php:
    template: KojoWorkerDecoratorComponent/Worker/PrimaryActorName/Proxy/AwareTrait.php
  <PrimaryActorName>/Factory.php:
    template: KojoWorkerDecoratorComponent/Worker/PrimaryActorName/Factory.php
  <PrimaryActorName>/Factory.service.yml:
    template: PrimaryActorName/Factory.service.yml
  <PrimaryActorName>/FactoryInterface.php:
    template: KojoWorkerDecoratorComponent/Worker/PrimaryActorName/FactoryInterface.php
  <PrimaryActorName>/Factory/AwareTrait.php:
    template: PrimaryActorName/Factory/AwareTrait.php
  <PrimaryActorName>/Builder.php:
    template: KojoWorkerDecoratorComponent/Worker/PrimaryActorName/Builder.php
  <PrimaryActorName>/Builder.service.yml:
    template: KojoWorkerDecoratorComponent/Worker/PrimaryActorName/Builder.service.yml
  <PrimaryActorName>/BuilderInterface.php:
    template: KojoWorkerDecoratorComponent/Worker/PrimaryActorName/BuilderInterface.php
  <PrimaryActorName>/Builder/AwareTrait.php:
    template: PrimaryActorName/Builder/AwareTrait.php
  <PrimaryActorName>/Builder/Factory.php:
    template: KojoWorkerDecoratorComponent/Worker/PrimaryActorName/Builder/Factory.php
  <PrimaryActorName>/Builder/Factory.service.yml:
    template: PrimaryActorName/Builder/Factory.service.yml
  <PrimaryActorName>/Builder/FactoryInterface.php:
    template: KojoWorkerDecoratorComponent/Worker/PrimaryActorName/Builder/FactoryInterface.php
  <PrimaryActorName>/Builder/Factory/AwareTrait.php:
    template: PrimaryActorName/Builder/Factory/AwareTrait.php

```

Implement `MyWorker.php`, `MyWorkerInterface.php` and `MyWorker/Proxy.php` after moving them from your fabrication folder to the source folder.  
Don't forget to define decorator parameters without default values mentioned [earlier](#decorator-stack).  
To modify the decorator stack move `MyWorker/Builder.service.yml` as well and adapt it.

The Proxy template is using [Neighborhoods Container Builder](https://github.com/neighborhoods/DependencyInjectionContainerBuilderComponent). For your convenience it is already added as a dependency, although it's not used in the source code.

### Custom decorator fabrication

If you also want a custom decorator add the `CustomDecorator.buphalo.v1.fabrication.yml` file with the content below. Preferably into the `MyWorker` subdirectory, next to the `Builder.service.yml` using it.

``` yaml
actors:
  <PrimaryActorName>.php:
    template: KojoWorkerDecoratorComponent/Decorator/PrimaryActorName.php
  <PrimaryActorName>.service.yml:
    template: KojoWorkerDecoratorComponent/Decorator/PrimaryActorName.service.yml
  <PrimaryActorName>Interface.php:
    template: KojoWorkerDecoratorComponent/Decorator/PrimaryActorNameInterface.php
  <PrimaryActorName>/AwareTrait.php:
    template: PrimaryActorName/AwareTrait.php
  <PrimaryActorName>/Factory.php:
    template: PrimaryActorName/Factory.php
  <PrimaryActorName>/Factory.service.yml:
    template: PrimaryActorName/Factory.service.yml
  <PrimaryActorName>/FactoryInterface.php:
    template: PrimaryActorName/FactoryInterface.php
  <PrimaryActorName>/Factory/AwareTrait.php:
    template: PrimaryActorName/Factory/AwareTrait.php
  <PrimaryActorName>/Builder.php:
    template: KojoWorkerDecoratorComponent/Decorator/PrimaryActorName/Builder.php
  <PrimaryActorName>/Builder.service.yml:
    template: PrimaryActorName/Builder.service.yml
  <PrimaryActorName>/BuilderInterface.php:
    template: KojoWorkerDecoratorComponent/Decorator/PrimaryActorName/BuilderInterface.php
  <PrimaryActorName>/Builder/AwareTrait.php:
    template: PrimaryActorName/Builder/AwareTrait.php
  <PrimaryActorName>/Builder/Factory.php:
    template: KojoWorkerDecoratorComponent/Decorator/PrimaryActorName/Builder/Factory.php
  <PrimaryActorName>/Builder/Factory.service.yml:
    template: KojoWorkerDecoratorComponent/Decorator/PrimaryActorName/Builder/Factory.service.yml
  <PrimaryActorName>/Builder/FactoryInterface.php:
    template: KojoWorkerDecoratorComponent/Decorator/PrimaryActorName/Builder/FactoryInterface.php
  <PrimaryActorName>/Builder/Factory/AwareTrait.php:
    template: PrimaryActorName/Builder/Factory/AwareTrait.php

```

Move the `MyWorker/CustomDecorator.php` file from your fabrication folder to the source folder and write the decoration logic.

## Examples

Application examples are available in the [Fitness](https://github.com/neighborhoods/KojoWorkerDecoratorComponentFitness) project.
