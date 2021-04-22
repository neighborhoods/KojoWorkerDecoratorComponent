<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1\Worker;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1\WorkerInterface;

trait AwareTrait
{
    protected $WorkerV1Worker;

    public function setWorkerV1Worker(WorkerInterface $Worker): self
    {
        if ($this->hasWorkerV1Worker()) {
            throw new LogicException('WorkerV1Worker is already set.');
        }
        $this->WorkerV1Worker = $Worker;

        return $this;
    }

    protected function getWorkerV1Worker(): WorkerInterface
    {
        if (!$this->hasWorkerV1Worker()) {
            throw new LogicException('WorkerV1Worker is not set.');
        }

        return $this->WorkerV1Worker;
    }

    protected function hasWorkerV1Worker(): bool
    {
        return isset($this->WorkerV1Worker);
    }

    protected function unsetWorkerV1Worker(): self
    {
        if (!$this->hasWorkerV1Worker()) {
            throw new LogicException('WorkerV1Worker is not set.');
        }
        unset($this->WorkerV1Worker);

        return $this;
    }
}
