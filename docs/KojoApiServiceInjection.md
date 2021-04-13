# Kōjō API Service Injection

When running a worker [Kōjō](https://github.com/neighborhoods/kojo) injects its [Worker Service](https://github.com/neighborhoods/kojo/blob/5.x/src/Api/V1/Worker/ServiceInterface.php) and/or [RDBMS Connection Service](https://github.com/neighborhoods/kojo/blob/5.x/src/Api/V1/RDBMS/Connection/ServiceInterface.php), if the worker is aware of them. See [here](https://github.com/neighborhoods/kojo/blob/b6d8dd2959bcb938a6074e52f579d3bd0425013a/src/Foreman.php#L88).  
The worker communicates with Kōjō using the injected services, e.g. indicates success/failure and schedules new jobs.

## Proxy

When the worker implementation uses Dependency Injection, an actor is need to boot the DI container. The actor is called **proxy**.  
The proxy is invoked by Kōjō and provided the Kōjō API services since it is aware of them.
The proxy provides the services to the DI container during boot and builds a worker it can run.

## DI service definitions

The Kōjō API services can be injected into the DI container using [synthetic services](https://symfony.com/doc/4.4/service_container/synthetic_services.html). Containers with synthetic services can be cached.  
Synthetic services have some limitations, for example they cannot be decorated. To overcome those limitations every Kōjō API service has two DI service definitions.
* Synthetic service definition  
This is where the Kōjō API service will be injected during container booting. It suffers from synthetic service limitations. The service id doesn't match the fully qualified name of the Kōjō API service interface. Only the delegator service definition should have it as a dependency.
* Delegator service definition  
The service id matches the fully qualified name of the Kōjō API service interface. This is what should be used by all other services which are aware of the Kōjō API service. The delegator forwards method invocations to the Kōjō API service. It doesn't suffer from synthetic service limitations.
  
The service definition files can be found [here](../src/KojoApiV1/WorkerService.service.yml) and [here](../src/KojoApiV1/RDBMSConnectionService.service.yml).

### Logger

Kōjō provides a PSR compatible Logger, which can be obtained using the `getLogger()` method from the Worker Service.  
Classes logging things don't need the Worker Service, but only the Logger. They can use the `Neighborhoods/Kojo/Api/V1/Logger/AwareTrait` and inject the `Neighborhoods/Kojo/Api/V1/LoggerInterface` DI service defined [here](../src/KojoApiV1/Logger.service.yml).

Since the Kojo Logger is PSR compatible, it can be injected to any class implementing `Psr\Log\LoggerAwareInterface`.

### Job Scheduler

The Worker Service also provides the Job Scheduler. Unlike the Logger, the Job Scheduler has internal state, which is why the class using it needs a new instance every time it schedules a job.  
Therefore, it doesn't make sense to expose the Job Scheduler as a DI service. Classes using the Job Schedule need to be Worker Service aware and use it's `getNewJobScheduler()` method every time they schedule a job.

## Testing

Having synthetic services causes difficulties with tests using a container. The synthetic services have to be set on the test container during `setUp()`. Mocked instances can be used. The `getLogger()` method on the Worker Service has to be configured to return a Logger, otherwise getting DI services from the DI container which have the Logger in their dependency tree would fail.

``` php
use Neighborhoods\Kojo\Api\V1;
use PHPUnit\Framework\TestCase;

class ContainerAwareTestCase extends TestCase
{
    public $container;
    public $kojoApiV1WorkerServiceMock;
    public $kojoApiV1RDBMSConnectionServiceMock;
    public $kojoApiV1LoggerMock;
    
    public method setUp(): void
    {
        parent::setUp();
        // Container must be Symfony DI Container.
        $this->conatiner = ...

        $this->kojoApiV1WorkerServiceMock = $this->createMock(V1\Worker\ServiceInterface::class);
        $this->kojoApiV1RDBMSConnectionServiceMock = $this->createMock(V1\RDBMS\Connection\ServiceInterface::class);
        $this->kojoApiV1LoggerMock = $this->createMock(V1\LoggerInterface::class);
        $this->kojoApiV1WorkerServiceMock->method('getLogger')
            ->willReturn($this->kojoApiV1LoggerMock);
            
        $this->container->set(V1\Worker\ServiceInterface::class . '.synthetic', $this->kojoApiV1WorkerServiceMock);
        $this->container->set(V1\RDBMS\Connection\ServiceInterface::class . '.synthetic', $this->kojoApiV1RDBMSConnectionServiceMock);
    }
}
```
