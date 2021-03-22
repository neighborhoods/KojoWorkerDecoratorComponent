<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker\ReschedulingDecorator\Builder\Factory;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\Worker\ReschedulingDecorator\Builder\FactoryInterface;

trait AwareTrait
{
    protected $WorkerReschedulingDecoratorBuilderFactory;

    public function setWorkerReschedulingDecoratorBuilderFactory(FactoryInterface $ReschedulingDecoratorBuilderFactory): self
    {
        if ($this->hasWorkerReschedulingDecoratorBuilderFactory()) {
            throw new LogicException('WorkerReschedulingDecoratorBuilderFactory is already set.');
        }
        $this->WorkerReschedulingDecoratorBuilderFactory = $ReschedulingDecoratorBuilderFactory;

        return $this;
    }

    protected function getWorkerReschedulingDecoratorBuilderFactory(): FactoryInterface
    {
        if (!$this->hasWorkerReschedulingDecoratorBuilderFactory()) {
            throw new LogicException('WorkerReschedulingDecoratorBuilderFactory is not set.');
        }

        return $this->WorkerReschedulingDecoratorBuilderFactory;
    }

    protected function hasWorkerReschedulingDecoratorBuilderFactory(): bool
    {
        return isset($this->WorkerReschedulingDecoratorBuilderFactory);
    }

    protected function unsetWorkerReschedulingDecoratorBuilderFactory(): self
    {
        if (!$this->hasWorkerReschedulingDecoratorBuilderFactory()) {
            throw new LogicException('WorkerReschedulingDecoratorBuilderFactory is not set.');
        }
        unset($this->WorkerReschedulingDecoratorBuilderFactory);

        return $this;
    }
}
