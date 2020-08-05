<?php

declare(strict_types=1);

namespace WorkerDecorator;

use Neighborhoods\Kojo\Doctrine\Connection\Decorator;
use Neighborhoods\Kojo\Doctrine\Connection\Decorator\Repository\AwareTrait;
use Neighborhoods\Kojo\Doctrine\Connection\DecoratorArray;
use Neighborhoods\Kojo\Doctrine\Connection\DecoratorArray\Factory;
use Neighborhoods\Kojo\PDO\Builder\FactoryInterface;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorator\UserlandPDO;

class UserlandPDOTest extends \PHPUnit\Framework\TestCase
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
        $initialPDO = $this->createMock(\PDO::class);
        $connectionDecorator->setPDO($initialPDO);

        $workerService = new \Neighborhoods\Kojo\Api\V1\RDBMS\Connection\Service();
        $workerService->setDoctrineConnectionDecoratorRepository($connectionDecoratorRepo);
        $workerService->setDoctrineConnectionDecoratorFactory(
            (new Decorator\Factory())->setDoctrineConnectionDecorator(new Decorator())
        );
        $workerService->usePDO($initialPDO);

        $newPDO = $this->createMock(\PDO::class);
        $worker = new class (
            function (bool $condition) {
                $this->assertTrue($condition);
            },
            $newPDO
        ) {
            use AwareTrait;
            use \Neighborhoods\Pylon\Data\Property\Defensive\AwareTrait;

            /**
             * @var \Closure
             */
            private $assert;
            /**
             * @var \PDO
             */
            private $newPdo;

            public function __construct(\Closure $assert, \PDO $newPdo)
            {
                $this->assert = $assert;
                $this->newPdo = $newPdo;
            }

            public function doSomething(): void
            {
                $reflection = new \ReflectionClass(Decorator::class);
                $refProp = $reflection->getProperty('_pdo');
                $refProp->setAccessible(true);
                $usedPDO = $refProp->getValue(
                    $this->_getDoctrineConnectionDecoratorRepository()
                        ->get('job')
                );

                // Asserting that PDO object has been changed
                ($this->assert)($usedPDO === $this->newPdo);
            }
        };
        $worker->setDoctrineConnectionDecoratorRepository($connectionDecoratorRepo);

        $decorator = new UserlandPDO();
        $decorator->setConnection($newPDO);
        $decorator->setWorker($worker);
        $decorator->setWorkerMethod('doSomething');
        $decorator->setApiV1RDBMSConnectionService($workerService);

        $decorator->work();
    }
}
