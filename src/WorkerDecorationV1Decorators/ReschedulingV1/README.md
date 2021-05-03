# Rescheduling V1
This decorator is intended for jobs rescheduling themselves (observers). It completes the running job with success and schedules the next, possibly delayed.

The completion and scheduling is atomic, since it's done in a transaction, which is why this decorator needs to know what connection is used by Kōjō. Use the [Userland PDO Decorator](../UserlandPdoV1/README.md) to set the Kōjō connection. The values of the connection related DI parameters for the Rescheduling Decorator should match the values of the corresponding DI parameters for the Userland PDO Decorator.

The decorated worker shouldn't complete with success since the Rescheduling Decorator does.  
The decorator doesn't reschedule if the decorated worker has already applied a state change request, e.g. has held or has completed with success. If that is the case, the decorator logs a warning.  
The warning will be logged if another decorator between the Rescheduling Decorator and Worker applies a state change request, for example the [Retry Threshold Decorator](../RetryThresholdV1/README.md) due to too many retries. Therefore, it's recommended to have the Rescheduling Decorator as innermost, i.e. at the top of the decorator stack in the worker builder's service definition/YAML file, like it's done in the [example](https://github.com/neighborhoods/KojoWorkerDecoratorComponentFitness/blob/main/src/ReschedulingDecorator/Worker/Builder.service.yml#L9).

## Paths
This decorator's DI services require DI services from the [Throwable Diagnostic Component](https://github.com/neighborhoods/ThrowableDiagnosticComponent), in addition to the corresponding source and fabrication subfolders.
``` php
$containerBuilder->addSourcePath(
    'vendor/neighborhoods/throwable-diagnostic-component/src'
);
$containerBuilder->addSourcePath(
    'vendor/neighborhoods/kojo-worker-decorator-component/fab/WorkerDecorationV1Decorators/ReschedulingV1'
);
$containerBuilder->addSourcePath(
    'vendor/neighborhoods/kojo-worker-decorator-component/src/WorkerDecorationV1Decorators/ReschedulingV1'
);
```

## DI Parameters

### Job Type Code
Type: string  
Job type code of the scheduled job. Doesn't have a default value. This should be the worker's job type code if the job reschedules itself.  
Full name: `Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\ReschedulingV1\ReschedulingDecoratorInterface.jobTypeCode`

### Reschedule Delay Seconds
Type: integer  
Minimal allowed value: 0  
Number of seconds between completing the current and starting the next job.  
Full name: `Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\ReschedulingV1\ReschedulingDecoratorInterface.reschedulingDelaySeconds`

The decorator itself expects the Kōjō connection. In practice the connection is obtained from a Prefab5 connection repository, which is done by the Rescheduling Decorator Builder.  
So the builder requires the Kōjō connection id, which is injected using a Symfony DI parameter, and the Prefab5 connection repository, which is injected using a Symfony DI service.
### Connection ID
Type: string  
Default value: core  
ID of Prefab5 Doctrine DBAL connection used by the Kōjō API Worker Service. If the Userland PDO Decorator is used, the value has to match its connectionId parameter value.  
Full name: `Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\ReschedulingV1\ReschedulingDecorator\BuilderInterface.connectionId`

### Prefab5 Connection Repository
The Prefab5 connection repository doesn't have a default value. The Symfony DI service `Vendor\Product\Prefab5\Doctrine\DBAL\Connection\Decorator\RepositoryInterface` has to be defined. The easiest way to do so is by defining it as an alias of the corresponding Prefab5 generated class.  
The same has to be done for Userland PDO Decorator. There is no need to define the same alias twice, so it is enough to define it in one place.
