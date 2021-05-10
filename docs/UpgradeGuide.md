# Upgrading from v2 to v3

The upgrade guide from v1 to v2 is available [here](https://github.com/neighborhoods/KojoWorkerDecoratorComponent/blob/2.0.0/docs/UpgradeGuide.md).

Version 2 of KWDC is compatible with [Throwable Diagnostic Component](https://github.com/neighborhoods/ThrowableDiagnosticComponent) version 3, while KWDC version 3 upgraded to Throwable Diagnostic Component version 4. Except that, no changes have been made.

To upgrade using composer run
```bash
composer require neighborhoods/kojo-worker-decorator-component:^3
```
Update both packages simultaneously if Throwable Diagnostic Component is listed as a direct dependency.
```bash
composer require neighborhoods/kojo-worker-decorator-component:^3 neighborhoods/throwable-diagnostic-component:^4
```
If Throwable Diagnostic Component isn't used in your product code, the only needed change is an update of container builder paths.  
Follow the Throwable Diagnostic Component [upgrade guide](https://github.com/neighborhoods/ThrowableDiagnosticComponent/tree/4.0.0/docs/UpgradeGuide.md) if it is used in your product code.

## Update container builder paths
Throwable Diagnostic Component version 3 had all the code in the source folder, but in Throwable Diagnostic Component version 4 fabricated files have been moved into the fabrication folder. Therefore, when including the source folder, also include the fabrication folder.

KWDC Version 2 with throwable Diagnostic Component version 3
```php
// Add KojoWorkerDecoratorComponent and ThrowableDiagnosticComponent service definitions
$containerBuilder
    ->addSourcePath('vendor/neighborhoods/kojo-worker-decorator-component/fab')
    ->addSourcePath('vendor/neighborhoods/kojo-worker-decorator-component/src')
    ->addSourcePath('vendor/neighborhoods/throwable-diagnostic-component/src');
```
KWDC Version 3 with Throwable Diagnostic Component version 4
```php
// Add KojoWorkerDecoratorComponent and ThrowableDiagnosticComponent service definitions
$containerBuilder
    ->addSourcePath('vendor/neighborhoods/kojo-worker-decorator-component/fab')
    ->addSourcePath('vendor/neighborhoods/kojo-worker-decorator-component/src')
    ->addSourcePath('vendor/neighborhoods/throwable-diagnostic-component/fab')
    ->addSourcePath('vendor/neighborhoods/throwable-diagnostic-component/src');
```
Throwable Diagnostic Component version 4 is designed for selective inclusion of DI services. The only paths needed by KWDC are listed in the [PostgresV1 README](https://github.com/neighborhoods/ThrowableDiagnosticComponent/tree/4.0.0/src/ThrowableDiagnosticV1Decorators/PostgresV1/README.md#paths). If Throwable Diagnostic Component paths are included only because of KWDC, they may be replaced by the following paths.
```php
// Add KojoWorkerDecoratorComponent and ThrowableDiagnosticComponent service definitions
$containerBuilder
    ->addSourcePath('vendor/neighborhoods/kojo-worker-decorator-component/fab')
    ->addSourcePath('vendor/neighborhoods/kojo-worker-decorator-component/src')
    ->addSourcePath('vendor/neighborhoods/throwable-diagnostic-component/fab/ThrowableDiagnosticV1')
    ->addSourcePath('vendor/neighborhoods/throwable-diagnostic-component/src/ThrowableDiagnosticV1')
    ->addSourcePath('vendor/neighborhoods/throwable-diagnostic-component/fab/ThrowableDiagnosticV1Decorators/PostgresV1')
    ->addSourcePath('vendor/neighborhoods/throwable-diagnostic-component/src/ThrowableDiagnosticV1Decorators/PostgresV1');
```
