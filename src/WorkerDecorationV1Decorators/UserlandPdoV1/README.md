# Userland PDO V1
Configures Kōjō API Worker Service to use a specific connection, core by default.
Knowing the connection enables worker logic to isolate job state changes into transactions.

## Paths
As usual the DI service definition are located in the corresponding source and fabrication subfolders.
```php
$containerBuilder
    ->addSourcePath('vendor/neighborhoods/kojo-worker-decorator-component/fab/WorkerDecorationV1Decorators/UserlandPdoV1')
    ->addSourcePath('vendor/neighborhoods/kojo-worker-decorator-component/src/WorkerDecorationV1Decorators/UserlandPdoV1');
```

## DI Parameters
The decorator itself expects a connection. In practice the connection is obtained from a Prefab5 connection repository, which is done by the Userland PDO Decorator Builder.
So the builder requires the connection id, which is injected using a Symfony DI parameter, and the Prefab5 connection repository, which is injected using a Symfony DI service.

### Connection ID
Type: string  
Default value: core  
ID of Prefab5 Doctrine DBAL connection to be used by the Kōjō API Worker Service.  
Full name: `Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\UserlandPdoV1\UserlandPdoDecorator\BuilderInterface.connectionId`

### Prefab5 Connection Repository
The Prefab5 connection repository doesn't have a default value. The Symfony DI service `Vendor\Product\Prefab5\Doctrine\DBAL\Connection\Decorator\RepositoryInterface` has to be defined. The easiest way to do so is by defining it as an alias of the corresponding Prefab5 generated class.
