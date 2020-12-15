<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker\Builder\Factory;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\Worker\Builder\FactoryInterface;

trait AwareTrait
{
    protected $WorkerBuilderFactory;

    public function setWorkerBuilderFactory(FactoryInterface $WorkerBuilderFactory): self
    {
        if ($this->hasWorkerBuilderFactory()) {
            throw new LogicException('WorkerBuilderFactory is already set.');
        }
        $this->WorkerBuilderFactory = $WorkerBuilderFactory;

        return $this;
    }

    protected function getWorkerBuilderFactory(): FactoryInterface
    {
        if (!$this->hasWorkerBuilderFactory()) {
            throw new LogicException('WorkerBuilderFactory is not set.');
        }

        return $this->WorkerBuilderFactory;
    }

    protected function hasWorkerBuilderFactory(): bool
    {
        return isset($this->WorkerBuilderFactory);
    }

    protected function unsetWorkerBuilderFactory(): self
    {
        if (!$this->hasWorkerBuilderFactory()) {
            throw new LogicException('WorkerBuilderFactory is not set.');
        }
        unset($this->WorkerBuilderFactory);

        return $this;
    }
}
