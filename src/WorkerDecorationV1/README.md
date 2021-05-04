# Worker Decoration V1

## Technical Design Artifacts

[Runtime Schematics](https://drive.google.com/file/d/1lLQck0XMuAYdVEGzQB01sgJUm8WNa1jg)

## Predefined decorators

* [Exception Handling Decorator](../WorkerDecorationV1Decorators/ExceptionHandlingV1/README.md) *recommended*
* [Crashed Threshold Decorator](../WorkerDecorationV1Decorators/CrashedThresholdV1/README.md) *recommended*
* [Retry Threshold Decorator](../WorkerDecorationV1Decorators/RetryThresholdV1/README.md) *recommended*
* [Userland PDO Decorator](../WorkerDecorationV1Decorators/UserlandPdoV1/README.md) *recommended*
* [Rescheduling Decorator](../WorkerDecorationV1Decorators/ReschedulingV1/README.md)

All decorators use compatible Buphalo decorator templates.

## Usage

Kōjō doesn't enforce any interface to workers, but this component does. To decorate your worker it must implement the
`Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1\WorkerInterface`. This can be easily done by using the `AwareTrait` for Kojo API Worker Service and Kojo API RDBMS Connection Service as shown below.

``` php
<?php
namespace Acme;

use Neighborhoods\Kojo\Api\V1;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1\WorkerInterface;

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
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1\WorkerInterface;
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

The `MyWorker\Builder\FactoryInterface` should extend the `Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1\Worker\Builder\FactoryInterface`. That way the `create()` method will provide a builder which implements `Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1\Worker\BuilderInterface`, for example `Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1\Worker\Builder`.

If predefined decorators are used, add the corresponding paths to the container builder's source paths. Have a look at the predefined decorator documentation to see which those are.  
The decorator DI service definitions may depend on services defined in other components. To avoid addition of paths to other components only add paths to used decorators. This prevents your code from breaking due to addition of a new decorator with dependency to previously unrelated components.
``` php
// Discover used predefined service definitions
$containerBuilder->addSourcePath(
    'vendor/neighborhoods/kojo-worker-decorator-component/fab/WorkerDecorationV1Decorators/ExceptionHandlingV1'
);
$containerBuilder->addSourcePath(
    'vendor/neighborhoods/kojo-worker-decorator-component/src/WorkerDecorationV1Decorators/ExceptionHandlingV1'
);
```
There are no DI service definitions in this folder (`WorkerDecorationV1`), there's no need to list it.

The container building and caching can be extracted from the Proxy into a dedicated class in order to test it.

### Decorator stack

Configure the builder using Symfony DI to build a decorator stack tailored to your needs. The `ExceptionHandlingDecorator` should be the last in the list, i.e. the outermost. An example is shown below.

``` yaml
# Acme\MyWorker\Builder.service.yml
services:
  Acme\MyWorker\BuilderInterface:
    class: Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1\Worker\Builder
    public: false
    shared: false
    calls:
      - [setWorkerDecorationV1WorkerFactory, ['@Acme\MyWorker\FactoryInterface']]
      # Add predefined and custom decorators
      - [addDecoratorBuilderFactory, ['@Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\RetryThresholdV1\RetryThresholdDecorator\Builder\FactoryInterface']]
      - [addDecoratorBuilderFactory, ['@Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\CrashedThresholdV1\CrashedThresholdDecorator\Builder\FactoryInterface']]
      - [addDecoratorBuilderFactory, ['@Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\UserlandPdoV1\UserlandPdoDecorator\Builder\FactoryInterface']]
      - [addDecoratorBuilderFactory, ['@Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\ExceptionHandlingV1\ExceptionHandlingDecorator\Builder\FactoryInterface']]

```

Decorator parameters have default values when possible.  
The [Userland PDO Decorator](../WorkerDecorationV1Decorators/UserlandPdoV1/README.md#prefab5-connection-repository) builder requires the `Vendor\Product\Prefab5\Doctrine\DBAL\Connection\Decorator\RepositoryInterface` service, which doesn't have a default value. How to define it is shown in an [example](https://github.com/neighborhoods/KojoWorkerDecoratorComponentFitness/blob/main/src/SuccessWorker/Worker/UserlandPdoDecorator/Builder.service.yml).  
The [Rescheduling Decorator](../WorkerDecorationV1Decorators/ReschedulingV1/README.md#di-parameters) is missing default values for jobTypeCode, rescheduleDelaySeconds and `Vendor\Product\Prefab5\Doctrine\DBAL\Connection\Decorator\RepositoryInterface` service. How to define them is shown in an [example](https://github.com/neighborhoods/KojoWorkerDecoratorComponentFitness/blob/main/src/ReschedulingDecorator/Worker/ReschedulingDecorator.service.yml).

Other decorator parameters are defined using DI parameters. The default parameter values can be overridden by redefining them. Make sure that the file containing the value you want to be applied is loaded last, i.e. load the service definitions from you project after service definitions from your dependencies.  
To avoid mixing worker builder and decorator definitions, provide them in separate yaml files. An [example](https://github.com/neighborhoods/KojoWorkerDecoratorComponentFitness/tree/main/src/DecoratorParameters/Worker) is available.

## Custom decorator

In addition to the decorators provided in this component, you may implement your own decorator(s).  
It has to extend the `Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1\Worker\DecoratorInterface` interface, which will be mostly implemented using the `Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1\Worker\DecoratorTrait` trait. The only method left to implement is the `work()` method, which at some point might run the decorated worker as shown below.
``` php
<?php

namespace Acme\MyWorker;

use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1\Worker;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1\WorkerInterface;

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

Create a builder and builder factory for the custom decorator by implementing the `Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1\Worker\Decorator\BuilderInterface` and `Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1\Worker\Decorator\Builder\FactoryInterface` interfaces respectively. After defining corresponding Symfony DI services, the builder factory for the custom decorator can be added to the worker builder (`Acme\MyWorker\Builder.service.yml` in given examples).

A full implementation of a custom decorator is provided in [this example](https://github.com/neighborhoods/KojoWorkerDecoratorComponentFitness/blob/main/src/CustomDecorator/Worker/CustomDecorator.php).

## Buphalo integration

[Buphalo](https://github.com/neighborhoods/Buphalo) templates are available for workers and custom decorators as well as their accompanying files.

To use the buphalo templates follow the steps explained [here](../../README.md#prerequisites).

### Worker fabrication

Create the file `MyWorker.buphalo.v1.fabrication.yml` if it doesn't already exist and make sure it has the following lines.

``` yaml
actors:
  <PrimaryActorName>.php:
    template: KojoWorkerDecoratorComponent/WorkerDecorationV1/WorkerV1/PrimaryActorName.php
  <PrimaryActorName>.service.yml:
    template: PrimaryActorName.service.yml
  <PrimaryActorName>Interface.php:
    template: KojoWorkerDecoratorComponent/WorkerDecorationV1/WorkerV1/PrimaryActorNameInterface.php
  <PrimaryActorName>/AwareTrait.php:
    template: PrimaryActorName/AwareTrait.php
  <PrimaryActorName>/Proxy.php:
    template: KojoWorkerDecoratorComponent/WorkerDecorationV1/WorkerV1/PrimaryActorName/Proxy.php
  <PrimaryActorName>/Proxy.service.yml:
    template: KojoWorkerDecoratorComponent/WorkerDecorationV1/WorkerV1/PrimaryActorName/Proxy.service.yml
  <PrimaryActorName>/ProxyInterface.php:
    template: KojoWorkerDecoratorComponent/WorkerDecorationV1/WorkerV1/PrimaryActorName/ProxyInterface.php
  <PrimaryActorName>/Proxy/AwareTrait.php:
    template: KojoWorkerDecoratorComponent/WorkerDecorationV1/WorkerV1/PrimaryActorName/Proxy/AwareTrait.php
  <PrimaryActorName>/Container.php:
    template: KojoWorkerDecoratorComponent/WorkerDecorationV1/WorkerV1/PrimaryActorName/Container.php
  <PrimaryActorName>/ContainerInterface.php:
    template: KojoWorkerDecoratorComponent/WorkerDecorationV1/WorkerV1/PrimaryActorName/ContainerInterface.php
  <PrimaryActorName>/Factory.php:
    template: KojoWorkerDecoratorComponent/WorkerDecorationV1/WorkerV1/PrimaryActorName/Factory.php
  <PrimaryActorName>/Factory.service.yml:
    template: PrimaryActorName/Factory.service.yml
  <PrimaryActorName>/FactoryInterface.php:
    template: KojoWorkerDecoratorComponent/WorkerDecorationV1/WorkerV1/PrimaryActorName/FactoryInterface.php
  <PrimaryActorName>/Factory/AwareTrait.php:
    template: PrimaryActorName/Factory/AwareTrait.php
  <PrimaryActorName>/Builder.php:
    template: KojoWorkerDecoratorComponent/WorkerDecorationV1/WorkerV1/PrimaryActorName/Builder.php
  <PrimaryActorName>/Builder.service.yml:
    template: KojoWorkerDecoratorComponent/WorkerDecorationV1/WorkerV1/PrimaryActorName/Builder.service.yml
  <PrimaryActorName>/BuilderInterface.php:
    template: KojoWorkerDecoratorComponent/WorkerDecorationV1/WorkerV1/PrimaryActorName/BuilderInterface.php
  <PrimaryActorName>/Builder/AwareTrait.php:
    template: PrimaryActorName/Builder/AwareTrait.php
  <PrimaryActorName>/Builder/Factory.php:
    template: KojoWorkerDecoratorComponent/WorkerDecorationV1/WorkerV1/PrimaryActorName/Builder/Factory.php
  <PrimaryActorName>/Builder/Factory.service.yml:
    template: PrimaryActorName/Builder/Factory.service.yml
  <PrimaryActorName>/Builder/FactoryInterface.php:
    template: KojoWorkerDecoratorComponent/WorkerDecorationV1/WorkerV1/PrimaryActorName/Builder/FactoryInterface.php
  <PrimaryActorName>/Builder/Factory/AwareTrait.php:
    template: PrimaryActorName/Builder/Factory/AwareTrait.php

```

Implement `MyWorker.php`, `MyWorkerInterface.php` and `MyWorker/Container.php` after moving them from your fabrication folder to the source folder.  
Don't forget to define decorator parameters without default values mentioned [earlier](#decorator-stack).  
To modify the decorator stack move `MyWorker/Builder.service.yml` as well and adapt it.

The Container template is using [Neighborhoods Container Builder](https://github.com/neighborhoods/DependencyInjectionContainerBuilderComponent). For your convenience it is already added as a dependency, although it's not used in the source code.

### Custom decorator fabrication

If you also want a custom decorator add the `CustomDecorator.buphalo.v1.fabrication.yml` file with the content below. Preferably into the `MyWorker` subdirectory, next to the `Builder.service.yml` using it.

``` yaml
actors:
  <PrimaryActorName>.php:
    template: KojoWorkerDecoratorComponent/WorkerDecorationV1/DecoratorV1/PrimaryActorName.php
  <PrimaryActorName>.service.yml:
    template: KojoWorkerDecoratorComponent/WorkerDecorationV1/DecoratorV1/PrimaryActorName.service.yml
  <PrimaryActorName>Interface.php:
    template: KojoWorkerDecoratorComponent/WorkerDecorationV1/DecoratorV1/PrimaryActorNameInterface.php
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
    template: KojoWorkerDecoratorComponent/WorkerDecorationV1/DecoratorV1/PrimaryActorName/Builder.php
  <PrimaryActorName>/Builder.service.yml:
    template: PrimaryActorName/Builder.service.yml
  <PrimaryActorName>/BuilderInterface.php:
    template: KojoWorkerDecoratorComponent/WorkerDecorationV1/DecoratorV1/PrimaryActorName/BuilderInterface.php
  <PrimaryActorName>/Builder/AwareTrait.php:
    template: PrimaryActorName/Builder/AwareTrait.php
  <PrimaryActorName>/Builder/Factory.php:
    template: KojoWorkerDecoratorComponent/WorkerDecorationV1/DecoratorV1/PrimaryActorName/Builder/Factory.php
  <PrimaryActorName>/Builder/Factory.service.yml:
    template: KojoWorkerDecoratorComponent/WorkerDecorationV1/DecoratorV1/PrimaryActorName/Builder/Factory.service.yml
  <PrimaryActorName>/Builder/FactoryInterface.php:
    template: KojoWorkerDecoratorComponent/WorkerDecorationV1/DecoratorV1/PrimaryActorName/Builder/FactoryInterface.php
  <PrimaryActorName>/Builder/Factory/AwareTrait.php:
    template: PrimaryActorName/Builder/Factory/AwareTrait.php

```

Move the `MyWorker/CustomDecorator.php` file from your fabrication folder to the source folder and write the decoration logic.
