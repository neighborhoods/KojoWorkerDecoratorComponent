<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1\Worker;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1\WorkerInterface;

trait AwareTrait
{
    protected $WorkerDecorationV1Worker;

    public function setWorkerDecorationV1Worker(WorkerInterface $Worker): self
    {
        if ($this->hasWorkerDecorationV1Worker()) {
            throw new LogicException('WorkerDecorationV1Worker is already set.');
        }
        $this->WorkerDecorationV1Worker = $Worker;

        return $this;
    }

    protected function getWorkerDecorationV1Worker(): WorkerInterface
    {
        if (!$this->hasWorkerDecorationV1Worker()) {
            throw new LogicException('WorkerDecorationV1Worker is not set.');
        }

        return $this->WorkerDecorationV1Worker;
    }

    protected function hasWorkerDecorationV1Worker(): bool
    {
        return isset($this->WorkerDecorationV1Worker);
    }

    protected function unsetWorkerDecorationV1Worker(): self
    {
        if (!$this->hasWorkerDecorationV1Worker()) {
            throw new LogicException('WorkerDecorationV1Worker is not set.');
        }
        unset($this->WorkerDecorationV1Worker);

        return $this;
    }
}
