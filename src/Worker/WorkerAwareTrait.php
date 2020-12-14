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

    public function getWorkerMethod(): string
    {
        if ($this->workerMethod === null) {
            throw new \LogicException('Worker Method is not set');
        }

        return $this->workerMethod;
    }

    public function setWorkerMethod(string $workerMethod): self
    {
        if (isset($this->workerMethod)) {
            throw new \LogicException('Worker Method is already set');
        }
        $this->workerMethod = $workerMethod;

        return $this;
    }

    public function getWorker(): object
    {
        if ($this->worker === null) {
            throw new \LogicException('Worker is not set');
        }

        return $this->worker;
    }

    public function setWorker(object $worker): self
    {
        if (isset($this->worker)) {
            throw new \LogicException('Worker is already set');
        }
        $this->worker = $worker;

        return $this;
    }

    public function runWorker(): self
    {
        // @phpstan-ignore-next-line
        \call_user_func([$this->getWorker(), $this->getWorkerMethod()]);

        return $this;
    }
}
