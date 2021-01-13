<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker\UserlandPdoDecorator\Builder\Factory;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\Worker\UserlandPdoDecorator\Builder\FactoryInterface;

trait AwareTrait
{
    protected $WorkerUserlandPdoDecoratorBuilderFactory;

    public function setWorkerUserlandPdoDecoratorBuilderFactory(FactoryInterface $UserlandPdoDecoratorBuilderFactory): self
    {
        if ($this->hasWorkerUserlandPdoDecoratorBuilderFactory()) {
            throw new LogicException('WorkerUserlandPdoDecoratorBuilderFactory is already set.');
        }
        $this->WorkerUserlandPdoDecoratorBuilderFactory = $UserlandPdoDecoratorBuilderFactory;

        return $this;
    }

    protected function getWorkerUserlandPdoDecoratorBuilderFactory(): FactoryInterface
    {
        if (!$this->hasWorkerUserlandPdoDecoratorBuilderFactory()) {
            throw new LogicException('WorkerUserlandPdoDecoratorBuilderFactory is not set.');
        }

        return $this->WorkerUserlandPdoDecoratorBuilderFactory;
    }

    protected function hasWorkerUserlandPdoDecoratorBuilderFactory(): bool
    {
        return isset($this->WorkerUserlandPdoDecoratorBuilderFactory);
    }

    protected function unsetWorkerUserlandPdoDecoratorBuilderFactory(): self
    {
        if (!$this->hasWorkerUserlandPdoDecoratorBuilderFactory()) {
            throw new LogicException('WorkerUserlandPdoDecoratorBuilderFactory is not set.');
        }
        unset($this->WorkerUserlandPdoDecoratorBuilderFactory);

        return $this;
    }
}
