<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker;

trait WorkerAwareTrait
{
    /**
     * @var object
     */
    private $worker;
    /**
     * @var string
     */
    private $workerMethod;

    /**
     * @return string
     */
    public function getWorkerMethod(): string
    {
        return $this->workerMethod;
    }

    /**
     * @param string $workerMethod
     */
    public function setWorkerMethod(string $workerMethod): void
    {
        $this->workerMethod = $workerMethod;
    }

    /**
     * @return object
     */
    public function getWorker(): object
    {
        return $this->worker;
    }

    /**
     * @param object $worker
     */
    public function setWorker(object $worker): void
    {
        $this->worker = $worker;
    }
}
