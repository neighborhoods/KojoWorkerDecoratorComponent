<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1\Worker;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1\WorkerInterface;

trait AwareTrait
{
    protected $Worker;

    public function setWorker(WorkerInterface $Worker): self
    {
        if ($this->hasWorker()) {
            throw new LogicException('Worker is already set.');
        }
        $this->Worker = $Worker;

        return $this;
    }

    protected function getWorker(): WorkerInterface
    {
        if (!$this->hasWorker()) {
            throw new LogicException('Worker is not set.');
        }

        return $this->Worker;
    }

    protected function hasWorker(): bool
    {
        return isset($this->Worker);
    }

    protected function unsetWorker(): self
    {
        if (!$this->hasWorker()) {
            throw new LogicException('Worker is not set.');
        }
        unset($this->Worker);

        return $this;
    }
}
