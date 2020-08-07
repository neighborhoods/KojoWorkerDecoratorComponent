# Kōjō Worker Decorators

A set of useful decorators for typical Worker definitions.

## Example service definition

```yaml
services:
  example-worker.with-pdo:
    class: Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorator\UserlandPDO
    public: true
    shared: false
    decorates: Neighborhoods\PeopleService\Worker1\ExampleWorkerInterface
    decoration_priority: 5
    calls:
      - [setWorker, ['@example-worker.with-pdo.inner']]
      - [setWorkerMethod, ['work']]
      - [setConnection, ['@=service("Neighborhoods\\PeopleService\\Prefab5\\Doctrine\\DBAL\\Connection\\Decorator\\RepositoryInterface").getConnection("core").getWrappedConnection()']]
      - [setApiV1RDBMSConnectionService, ['@example-worker.apiV1RDBMSConnectionService']]
  example-worker.with-exceptions:
    class: Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorator\ExceptionHandling
    public: true
    shared: false
    decorates: example-worker.with-pdo
    decoration_priority: 1
    calls:
      - [setWorker, ['@example-worker.with-exceptions.inner']]
      - [setWorkerMethod, ['work']]
      - [setApiV1WorkerService, ['@example-worker.apiV1WorkerService']]
``` 
