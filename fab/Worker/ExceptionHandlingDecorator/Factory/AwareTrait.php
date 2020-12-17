<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker\ExceptionHandlingDecorator\Factory;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\Worker\ExceptionHandlingDecorator\FactoryInterface;

trait AwareTrait
{
    protected $WorkerExceptionHandlingDecoratorFactory;

    public function setWorkerExceptionHandlingDecoratorFactory(FactoryInterface $ExceptionHandlingDecoratorFactory): self
    {
        if ($this->hasWorkerExceptionHandlingDecoratorFactory()) {
            throw new LogicException('WorkerExceptionHandlingDecoratorFactory is already set.');
        }
        $this->WorkerExceptionHandlingDecoratorFactory = $ExceptionHandlingDecoratorFactory;

        return $this;
    }

    protected function getWorkerExceptionHandlingDecoratorFactory(): FactoryInterface
    {
        if (!$this->hasWorkerExceptionHandlingDecoratorFactory()) {
            throw new LogicException('WorkerExceptionHandlingDecoratorFactory is not set.');
        }

        return $this->WorkerExceptionHandlingDecoratorFactory;
    }

    protected function hasWorkerExceptionHandlingDecoratorFactory(): bool
    {
        return isset($this->WorkerExceptionHandlingDecoratorFactory);
    }

    protected function unsetWorkerExceptionHandlingDecoratorFactory(): self
    {
        if (!$this->hasWorkerExceptionHandlingDecoratorFactory()) {
            throw new LogicException('WorkerExceptionHandlingDecoratorFactory is not set.');
        }
        unset($this->WorkerExceptionHandlingDecoratorFactory);

        return $this;
    }
}
