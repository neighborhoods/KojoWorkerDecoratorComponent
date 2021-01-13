<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker\UserlandPdoDecorator\Factory;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\Worker\UserlandPdoDecorator\FactoryInterface;

trait AwareTrait
{
    protected $WorkerUserlandPdoDecoratorFactory;

    public function setWorkerUserlandPdoDecoratorFactory(FactoryInterface $UserlandPdoDecoratorFactory): self
    {
        if ($this->hasWorkerUserlandPdoDecoratorFactory()) {
            throw new LogicException('WorkerUserlandPdoDecoratorFactory is already set.');
        }
        $this->WorkerUserlandPdoDecoratorFactory = $UserlandPdoDecoratorFactory;

        return $this;
    }

    protected function getWorkerUserlandPdoDecoratorFactory(): FactoryInterface
    {
        if (!$this->hasWorkerUserlandPdoDecoratorFactory()) {
            throw new LogicException('WorkerUserlandPdoDecoratorFactory is not set.');
        }

        return $this->WorkerUserlandPdoDecoratorFactory;
    }

    protected function hasWorkerUserlandPdoDecoratorFactory(): bool
    {
        return isset($this->WorkerUserlandPdoDecoratorFactory);
    }

    protected function unsetWorkerUserlandPdoDecoratorFactory(): self
    {
        if (!$this->hasWorkerUserlandPdoDecoratorFactory()) {
            throw new LogicException('WorkerUserlandPdoDecoratorFactory is not set.');
        }
        unset($this->WorkerUserlandPdoDecoratorFactory);

        return $this;
    }
}
