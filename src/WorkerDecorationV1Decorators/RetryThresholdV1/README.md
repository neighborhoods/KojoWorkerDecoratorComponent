# Retry Threshold V1
This decorator prevents jobs from repeatedly retrying.

The decorator holds the job when the number of retries exceeds the threshold.

## Paths
As usual the DI service definition are located in the corresponding source and fabrication subfolders.
``` php
$containerBuilder->addSourcePath(
    'vendor/neighborhoods/kojo-worker-decorator-component/fab/WorkerDecorationV1Decorators/RetryThresholdV1'
);
$containerBuilder->addSourcePath(
    'vendor/neighborhoods/kojo-worker-decorator-component/src/WorkerDecorationV1Decorators/RetryThresholdV1'
);
```

## DI Parameters
All DI parameters have default values.

### Threshold
Type: integer  
Default value: 100  
Minimal allowed value: 1  
Maximal number of crashes before holding the job.  
Full name:
`Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\RetryThresholdV1\RetryThresholdDecoratorInterface.threshold`
