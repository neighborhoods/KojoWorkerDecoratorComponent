# Exception Handling V1
This decorator handles exceptions thrown by the decorated worker.  
It prevents jobs from panicking. In case of a transient fault, the job is retried after a predefined interval. In case of a non-transient fault the job is held. Either way the exception is logged.

When defining the decorator stack make sure the exception handling decorator is the outermost, i.e. listed last in the worker builder's service definition/YAML file.

This decorator is compatible with [Exception Component](https://github.com/neighborhoods/ExceptionComponent) and [Throwable Diagnostic Component](https://github.com/neighborhoods/ThrowableDiagnosticComponent) when it comes to determining the transiency of an exception.

If a job panics, although the worker is decorated with the exception handling decorator, it means that an exception occurred before the decorator is invoked. If the Proxy template is used with the exception handling decorator being the last in the decorator stack, a job can only panic if there's a problem with building the container.  
This is most likely caused by a missing environment variable or invalid value.

## Paths
As usual the DI service definition are located in the corresponding source and fabrication subfolders.
```php
$containerBuilder
    ->addSourcePath('vendor/neighborhoods/kojo-worker-decorator-component/fab/WorkerDecorationV1Decorators/ExceptionHandlingV1')
    ->addSourcePath('vendor/neighborhoods/kojo-worker-decorator-component/src/WorkerDecorationV1Decorators/ExceptionHandlingV1');
```

## DI Parameters
All DI parameters have default values.

### Retry Interval
Type: string  
Default value: 1 minute  
String representation of `DateInterval` by which retry is delayed after catching a transient exception.  
Full name: `Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\ExceptionHandlingV1\ExceptionHandlingDecoratorInterface.retryIntervalDefinition`
  