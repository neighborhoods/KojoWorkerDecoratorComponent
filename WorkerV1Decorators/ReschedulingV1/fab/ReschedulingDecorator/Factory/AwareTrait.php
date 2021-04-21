<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\ReschedulingV1\ReschedulingDecorator\Factory;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\ReschedulingV1\ReschedulingDecorator\FactoryInterface;

trait AwareTrait
{
    protected $ReschedulingDecoratorFactory;

    public function setReschedulingDecoratorFactory(FactoryInterface $ReschedulingDecoratorFactory): self
    {
        if ($this->hasReschedulingDecoratorFactory()) {
            throw new LogicException('ReschedulingDecoratorFactory is already set.');
        }
        $this->ReschedulingDecoratorFactory = $ReschedulingDecoratorFactory;

        return $this;
    }

    protected function getReschedulingDecoratorFactory(): FactoryInterface
    {
        if (!$this->hasReschedulingDecoratorFactory()) {
            throw new LogicException('ReschedulingDecoratorFactory is not set.');
        }

        return $this->ReschedulingDecoratorFactory;
    }

    protected function hasReschedulingDecoratorFactory(): bool
    {
        return isset($this->ReschedulingDecoratorFactory);
    }

    protected function unsetReschedulingDecoratorFactory(): self
    {
        if (!$this->hasReschedulingDecoratorFactory()) {
            throw new LogicException('ReschedulingDecoratorFactory is not set.');
        }
        unset($this->ReschedulingDecoratorFactory);

        return $this;
    }
}
