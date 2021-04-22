<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1\Worker\Factory;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1\Worker\FactoryInterface;

trait AwareTrait
{
    protected $WorkerV1WorkerFactory;

    public function setWorkerV1WorkerFactory(FactoryInterface $WorkerFactory): self
    {
        if ($this->hasWorkerV1WorkerFactory()) {
            throw new LogicException('WorkerV1WorkerFactory is already set.');
        }
        $this->WorkerV1WorkerFactory = $WorkerFactory;

        return $this;
    }

    protected function getWorkerV1WorkerFactory(): FactoryInterface
    {
        if (!$this->hasWorkerV1WorkerFactory()) {
            throw new LogicException('WorkerV1WorkerFactory is not set.');
        }

        return $this->WorkerV1WorkerFactory;
    }

    protected function hasWorkerV1WorkerFactory(): bool
    {
        return isset($this->WorkerV1WorkerFactory);
    }

    protected function unsetWorkerV1WorkerFactory(): self
    {
        if (!$this->hasWorkerV1WorkerFactory()) {
            throw new LogicException('WorkerV1WorkerFactory is not set.');
        }
        unset($this->WorkerV1WorkerFactory);

        return $this;
    }
}
