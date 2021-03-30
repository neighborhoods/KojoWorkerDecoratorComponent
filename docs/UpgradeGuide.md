# Upgrading from v1 to v2

## Add Throwable Diagnostic Component source path
In version 2 the [`ReschedulingDecorator`](https://github.com/neighborhoods/KojoWorkerDecoratorComponent/blob/2.0.0/src/Worker/ReschedulingDecorator.php) was added. It's service definition depends on services defined in the [Throwable Diagnostic Component](https://github.com/neighborhoods/ThrowableDiagnosticComponent). To avoid a `ServiceNotFoundException` when building a container, make sure the path `vendor/neighborhoods/throwable-diagnostic-component/src` is added along kojo worker decorator component paths.

Version 1
``` php
// Add KojoWorkerDecoratorComponent service definitions
$containerBuilder->addSourcePath(
    'vendor/neighborhoods/kojo-worker-decorator-component/fab'
);
$containerBuilder->addSourcePath(
    'vendor/neighborhoods/kojo-worker-decorator-component/src'
);
```
Version 2
``` php
// Add KojoWorkerDecoratorComponent and ThrowableDiagnosticComponent service definitions
$containerBuilder->addSourcePath(
    'vendor/neighborhoods/kojo-worker-decorator-component/fab'
);
$containerBuilder->addSourcePath(
    'vendor/neighborhoods/kojo-worker-decorator-component/src'
);
$containerBuilder->addSourcePath(
    'vendor/neighborhoods/throwable-diagnostic-component/src'
);
```
If the Throwable Diagnostic Component source path is already added, no change is required.

## Proxy Container

The [template](https://github.com/neighborhoods/KojoWorkerDecoratorComponent/blob/2.0.0/template-tree/V1/KojoWorkerDecoratorComponent/Worker/PrimaryActorName/Proxy.php) for the `Proxy` has been modified.  
The container configuration, building and caching has been extracted into the [`Container` template](https://github.com/neighborhoods/KojoWorkerDecoratorComponent/blob/2.0.0/template-tree/V1/KojoWorkerDecoratorComponent/Worker/PrimaryActorName/Container.php) with a typed [interface](https://github.com/neighborhoods/KojoWorkerDecoratorComponent/blob/2.0.0/template-tree/V1/KojoWorkerDecoratorComponent/Worker/PrimaryActorName/ContainerInterface.php).

Since the fabricated `Proxy` class gets modified, your code should work without any changes, but if you want to stay aligned with how things are done in version 2 do the following steps:
 * In the worker's buphalo file add the `Container` and `ContainerInterface` actors.
``` yaml
actors:
  # unmodified existing actors followed by
  <PrimaryActorName>/Container.php:
    template: KojoWorkerDecoratorComponent/Worker/PrimaryActorName/Container.php
  <PrimaryActorName>/ContainerInterface.php:
    template: KojoWorkerDecoratorComponent/Worker/PrimaryActorName/ContainerInterface.php
```
 * Run [buphalo](https://github.com/neighborhoods/Buphalo) to fabricate the two new actors.
 * Move the fabricated `Container.php` file from the fabrication into the source folder.
 * Extract the builder configuration, building and caching from the `Proxy`'s `getContainer()` class into the `Container`'s `buildWrappedContainer()` method.

## ConnectionAwareTrait

The `Neighborhoods\KojoWorkerDecoratorComponent\Connection\ConnectionAwareTrait` from version 1 has been replaced by `Neighborhoods\KojoWorkerDecoratorComponent\Connection\AwareTrait` in version 2. Instead of being aware of `PDO` it's aware of `Doctrine\DBAL\Connection`.
