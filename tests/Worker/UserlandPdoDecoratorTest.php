<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Tests\Worker;

use Closure;
use Neighborhoods\Kojo\Api\V1;
use Neighborhoods\Kojo\Doctrine\Connection\Decorator;
use Neighborhoods\Kojo\Doctrine\Connection\Decorator\Repository\AwareTrait;
use Neighborhoods\Kojo\Doctrine\Connection\DecoratorArray;
use Neighborhoods\Kojo\Doctrine\Connection\DecoratorArray\Factory;
use Neighborhoods\Kojo\PDO\Builder\FactoryInterface;
use Neighborhoods\KojoWorkerDecoratorComponent\Worker\UserlandPdoDecorator;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1\WorkerInterface;
use PDO;
use PHPUnit\Framework\TestCase;
use ReflectionClass;

class UserlandPdoDecoratorTest extends TestCase
{
    public function testPDOChanged(): void
    {
        // initialize connection decorator + initial PDO
        $connectionDecorator = (new Decorator())->setId('job');
        $connectionDecorator->setPDOBuilderFactory($this->createMock(FactoryInterface::class));
        $connectionDecoratorRepo = new Decorator\Repository();
        $arrayFactory = new Factory();
        $mockedDecoratorArray = $this->createPartialMock(DecoratorArray::class, ['getArrayCopy']);
        // This is needed to fix "array spread" issue with non numeric arrays
        // We want to use "mapped" connections
        $mockedDecoratorArray->method('getArrayCopy')->willReturn($mockedDecoratorArray);
        $mockedDecoratorArray['job'] = $connectionDecorator;
        $arrayFactory->setDoctrineConnectionDecoratorArray($mockedDecoratorArray);
        $connectionDecoratorRepo->setDoctrineConnectionDecoratorArrayFactory($arrayFactory);
        $initialPDO = $this->createMock(PDO::class);
        $connectionDecorator->setPDO($initialPDO);

        $workerService = new V1\RDBMS\Connection\Service();
        $workerService->setDoctrineConnectionDecoratorRepository($connectionDecoratorRepo);
        $workerService->setDoctrineConnectionDecoratorFactory(
            (new Decorator\Factory())->setDoctrineConnectionDecorator(new Decorator())
        );
        $workerService->usePDO($initialPDO);

        $newPDO = $this->createMock(PDO::class);
        $worker = new class (
            function (bool $condition) {
            $this->assertTrue($condition);
            },
            $newPDO
        ) implements WorkerInterface {
            use AwareTrait;
            use V1\Worker\Service\AwareTrait;
            use V1\RDBMS\Connection\Service\AwareTrait;
            use \Neighborhoods\Pylon\Data\Property\Defensive\AwareTrait;

            /**
             * @var Closure
             */
            private $assert;
            /**
             * @var PDO
             */
            private $newPdo;

            public function __construct(Closure $assert, PDO $newPdo)
            {
                $this->assert = $assert;
                $this->newPdo = $newPdo;
            }

            public function work(): WorkerInterface
            {
                $reflection = new ReflectionClass(Decorator::class);
                $refProp = $reflection->getProperty('_pdo');
                $refProp->setAccessible(true);
                $usedPDO = $refProp->getValue(
                    $this->_getDoctrineConnectionDecoratorRepository()
                        ->get('job')
                );

                // Asserting that PDO object has been changed
                ($this->assert)($usedPDO === $this->newPdo);

                return $this;
            }
        };
        $worker->setDoctrineConnectionDecoratorRepository($connectionDecoratorRepo);

        $decorator = new UserlandPdoDecorator();
        $decorator->setPdo($newPDO);
        $decorator->setWorker($worker);
        $decorator->setApiV1RDBMSConnectionService($workerService);

        $decorator->work();
    }
}
