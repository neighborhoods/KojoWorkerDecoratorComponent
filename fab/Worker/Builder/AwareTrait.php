<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker\Builder;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\Worker\BuilderInterface;

trait AwareTrait
{
    protected $WorkerBuilder;

    public function setWorkerBuilder(BuilderInterface $WorkerBuilder): self
    {
        if ($this->hasWorkerBuilder()) {
            throw new LogicException('WorkerBuilder is already set.');
        }
        $this->WorkerBuilder = $WorkerBuilder;

        return $this;
    }

    protected function getWorkerBuilder(): BuilderInterface
    {
        if (!$this->hasWorkerBuilder()) {
            throw new LogicException('WorkerBuilder is not set.');
        }

        return $this->WorkerBuilder;
    }

    protected function hasWorkerBuilder(): bool
    {
        return isset($this->WorkerBuilder);
    }

    protected function unsetWorkerBuilder(): self
    {
        if (!$this->hasWorkerBuilder()) {
            throw new LogicException('WorkerBuilder is not set.');
        }
        unset($this->WorkerBuilder);

        return $this;
    }
}
