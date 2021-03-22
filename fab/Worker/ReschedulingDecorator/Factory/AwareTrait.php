<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker\ReschedulingDecorator\Factory;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\Worker\ReschedulingDecorator\FactoryInterface;

trait AwareTrait
{
    protected $WorkerReschedulingDecoratorFactory;

    public function setWorkerReschedulingDecoratorFactory(FactoryInterface $ReschedulingDecoratorFactory): self
    {
        if ($this->hasWorkerReschedulingDecoratorFactory()) {
            throw new LogicException('WorkerReschedulingDecoratorFactory is already set.');
        }
        $this->WorkerReschedulingDecoratorFactory = $ReschedulingDecoratorFactory;

        return $this;
    }

    protected function getWorkerReschedulingDecoratorFactory(): FactoryInterface
    {
        if (!$this->hasWorkerReschedulingDecoratorFactory()) {
            throw new LogicException('WorkerReschedulingDecoratorFactory is not set.');
        }

        return $this->WorkerReschedulingDecoratorFactory;
    }

    protected function hasWorkerReschedulingDecoratorFactory(): bool
    {
        return isset($this->WorkerReschedulingDecoratorFactory);
    }

    protected function unsetWorkerReschedulingDecoratorFactory(): self
    {
        if (!$this->hasWorkerReschedulingDecoratorFactory()) {
            throw new LogicException('WorkerReschedulingDecoratorFactory is not set.');
        }
        unset($this->WorkerReschedulingDecoratorFactory);

        return $this;
    }
}
