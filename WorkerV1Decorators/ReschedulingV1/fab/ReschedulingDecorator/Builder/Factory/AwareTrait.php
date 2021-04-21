<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\ReschedulingV1\ReschedulingDecorator\Builder\Factory;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\ReschedulingV1\ReschedulingDecorator\Builder\FactoryInterface;

trait AwareTrait
{
    protected $ReschedulingDecoratorBuilderFactory;

    public function setReschedulingDecoratorBuilderFactory(FactoryInterface $ReschedulingDecoratorBuilderFactory): self
    {
        if ($this->hasReschedulingDecoratorBuilderFactory()) {
            throw new LogicException('ReschedulingDecoratorBuilderFactory is already set.');
        }
        $this->ReschedulingDecoratorBuilderFactory = $ReschedulingDecoratorBuilderFactory;

        return $this;
    }

    protected function getReschedulingDecoratorBuilderFactory(): FactoryInterface
    {
        if (!$this->hasReschedulingDecoratorBuilderFactory()) {
            throw new LogicException('ReschedulingDecoratorBuilderFactory is not set.');
        }

        return $this->ReschedulingDecoratorBuilderFactory;
    }

    protected function hasReschedulingDecoratorBuilderFactory(): bool
    {
        return isset($this->ReschedulingDecoratorBuilderFactory);
    }

    protected function unsetReschedulingDecoratorBuilderFactory(): self
    {
        if (!$this->hasReschedulingDecoratorBuilderFactory()) {
            throw new LogicException('ReschedulingDecoratorBuilderFactory is not set.');
        }
        unset($this->ReschedulingDecoratorBuilderFactory);

        return $this;
    }
}
