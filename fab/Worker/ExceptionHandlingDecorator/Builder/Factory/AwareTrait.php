<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker\ExceptionHandlingDecorator\Builder\Factory;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\Worker\ExceptionHandlingDecorator\Builder\FactoryInterface;

trait AwareTrait
{
    protected $WorkerExceptionHandlingDecoratorBuilderFactory;

    public function setWorkerExceptionHandlingDecoratorBuilderFactory(FactoryInterface $ExceptionHandlingDecoratorBuilderFactory): self
    {
        if ($this->hasWorkerExceptionHandlingDecoratorBuilderFactory()) {
            throw new LogicException('WorkerExceptionHandlingDecoratorBuilderFactory is already set.');
        }
        $this->WorkerExceptionHandlingDecoratorBuilderFactory = $ExceptionHandlingDecoratorBuilderFactory;

        return $this;
    }

    protected function getWorkerExceptionHandlingDecoratorBuilderFactory(): FactoryInterface
    {
        if (!$this->hasWorkerExceptionHandlingDecoratorBuilderFactory()) {
            throw new LogicException('WorkerExceptionHandlingDecoratorBuilderFactory is not set.');
        }

        return $this->WorkerExceptionHandlingDecoratorBuilderFactory;
    }

    protected function hasWorkerExceptionHandlingDecoratorBuilderFactory(): bool
    {
        return isset($this->WorkerExceptionHandlingDecoratorBuilderFactory);
    }

    protected function unsetWorkerExceptionHandlingDecoratorBuilderFactory(): self
    {
        if (!$this->hasWorkerExceptionHandlingDecoratorBuilderFactory()) {
            throw new LogicException('WorkerExceptionHandlingDecoratorBuilderFactory is not set.');
        }
        unset($this->WorkerExceptionHandlingDecoratorBuilderFactory);

        return $this;
    }
}
