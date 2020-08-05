<?php

namespace Neighborhoods\KojoWorkerDecoratorComponent;

use Neighborhoods\Kojo\Api\V1\RDBMS\Connection\ServiceInterface;
use Neighborhoods\KojoWorkerDecoratorComponent\Worker\WorkerAwareTrait;

trait DelegateServiceGetterTrait
{
    use WorkerAwareTrait;

    public function getApiV1RDBMSConnectionService(): ServiceInterface
    {
        return $this->getDelegatedService('getApiV1RDBMSConnectionService');
    }

    public function getApiV1WorkerService(): \Neighborhoods\Kojo\Api\V1\Worker\ServiceInterface
    {
        return $this->getDelegatedService('getApiV1WorkerService');
    }

    private function getDelegatedService(string $methodCall)
    {
        $worker = $this->getWorker();
        if (method_exists($worker, $methodCall)) {
            try {
                return $worker->$methodCall();
            } catch (\Error $error) {
                $reflection = new \ReflectionClass(get_class($worker));
                $method = $reflection->getMethod($methodCall);
                $method->setAccessible(true);
                return $method->invoke($worker);
            }
        }
        throw new \LogicException('Not able to find ' . $methodCall);
    }
}
