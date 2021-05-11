# Crashed Threshold V1
This Kojo Worker Decorator prevents jobs from repeatedly crashing and defends against hysteresis.

A crash occurs when the worker doesn't gracefully exit, for example runs out of memory, segmentation fault, gets terminated due to a signal...

Kōjō attempts to rerun the job after the crash. This decorator detects that the job previously crashed and sleeps to prevent hysteresis.

The decorator holds the job when the number of crashes exceeds the threshold.

## Paths
As usual the DI service definition are located in the corresponding source and fabrication subfolders.
```php
$containerBuilder
    ->addSourcePath('vendor/neighborhoods/kojo-worker-decorator-component/fab/WorkerDecorationV1Decorators/CrashedThresholdV1')
    ->addSourcePath('vendor/neighborhoods/kojo-worker-decorator-component/src/WorkerDecorationV1Decorators/CrashedThresholdV1');
```

## DI Parameters
All DI parameters have default values.

### Threshold
Type: integer  
Default value: 5  
Minimal allowed value: 1  
Maximal number of crashes before holding the job.  
Full name:
`Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\CrashedThresholdV1\CrashedThresholdDecoratorInterface.threshold`

### Delay
Type: integer  
Default value: 1  
Minimal allowed value: 1  
Number of seconds by which execution is delayed after a crash.  
Full name: `Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\CrashedThresholdV1\CrashedThresholdDecoratorInterface.delaySeconds`
