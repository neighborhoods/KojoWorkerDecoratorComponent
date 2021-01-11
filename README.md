# Kōjō Worker Decorators

A set of useful decorators for a typical [Kōjō](https://github.com/neighborhoods/kojo) Worker.

##Technical Design Artifacts

[Runtime Schematics](https://drive.google.com/file/d/1lLQck0XMuAYdVEGzQB01sgJUm8WNa1jg)

## Install

Via Composer

``` bash
$ composer require neighborhoods/kojo-worker-decorator-component
```

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
The Proxy might use a Symfony DI container, as shown below, to obtain the builder for the worker and decorators. The decorators and worker can use dependency injection, while the Proxy cannot.

``` php
<?php
namespace Acme\MyWorker;

use Acme\MyWorker;
use Neighborhoods\ContainerBuilder\Builder;
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
        $containerBuilder = new Builder();
        // Container configuration
        $containerBuilder->registerServiceAsPublic(MyWorker\Builder\FactoryInterface::class);
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

Configure the builder using Symfony DI to build a decorator stack tailored to your needs. An example is shown below.

``` yaml
# Acme\MyWorker\Builder.service.yml
parameters:
  # This parameter is needed by CrashedThresholdDecorator
  Neighborhoods\KojoWorkerDecoratorComponent\Worker\CrashedThresholdDecoratorInterface.threshold: 5
  # This parameter is needed by ExceptionHandlingDecorator
  Neighborhoods\KojoWorkerDecoratorComponent\Worker\ExceptionHandlingDecoratorInterface.retryIntervalDefinition: 'PT5M'
services:
  # This service alias is needed by UserlandPdoDecorator
  Neighborhoods\KojoWorkerDecoratorComponent\Worker\UserlandPdoDecorator\BuilderInterface.prefabDoctrineDbalConnectionDecoratorRepository:
    alias: Acme\Prefab5\Doctrine\DBAL\Connection\Decorator\RepositoryInterface
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

Configurable decorators should provide default configuration values when possible. Those values are defined using DI parameters.  
The parameter values can be overridden by redefining them. Make sure that the file containing the value you want to be applied is loaded last, i.e. load the service definitions from you project after service definitions from your dependencies.  
To avoid mixing builder and decorator definitions, provide them in a separate yaml file. Few examples are shown below.

``` yaml
# Acme\MyWorker\CrashedThresholdDecorator.service.yml
# These parameter values override default values for CrashedThresholdDecorator
parameters:
  Neighborhoods\KojoWorkerDecoratorComponent\Worker\CrashedThresholdDecoratorInterface.threshold: 10
```
``` yaml
# Acme\MyWorker\ExceptionHandlingDecorator.service.yml
# These parameter values override default values for ExceptionHandlingDecorator
parameters:
  Neighborhoods\KojoWorkerDecoratorComponent\Worker\ExceptionHandlingDecoratorInterface.retryIntervalDefinition: 'PT5M'
```
``` yaml
# Acme\MyWorker\UserlandPdoDecorator.service.yml
# This service alias is needed by UserlandPdoDecorator
services:
  Neighborhoods\KojoWorkerDecoratorComponent\Worker\UserlandPdoDecorator\BuilderInterface.prefabDoctrineDbalConnectionDecoratorRepository:
    alias: Acme\Prefab5\Doctrine\DBAL\Connection\Decorator\RepositoryInterface
  Neighborhoods
```

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

Modify the `MyWorker/Builder.service.yml` to composes a decorator stack tailored to `MyWorker`. Before doing so move the file from your fabrication folder to the source folder.  
You must also move and implement the `MyWorker.php` and `MyWorker/Proxy.php`.

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
