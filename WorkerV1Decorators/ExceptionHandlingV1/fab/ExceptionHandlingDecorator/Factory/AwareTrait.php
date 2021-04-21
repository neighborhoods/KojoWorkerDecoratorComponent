<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\ExceptionHandlingV1\ExceptionHandlingDecorator\Factory;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\ExceptionHandlingV1\ExceptionHandlingDecorator\FactoryInterface;

trait AwareTrait
{
    protected $ExceptionHandlingDecoratorFactory;

    public function setExceptionHandlingDecoratorFactory(FactoryInterface $ExceptionHandlingDecoratorFactory): self
    {
        if ($this->hasExceptionHandlingDecoratorFactory()) {
            throw new LogicException('ExceptionHandlingDecoratorFactory is already set.');
        }
        $this->ExceptionHandlingDecoratorFactory = $ExceptionHandlingDecoratorFactory;

        return $this;
    }

    protected function getExceptionHandlingDecoratorFactory(): FactoryInterface
    {
        if (!$this->hasExceptionHandlingDecoratorFactory()) {
            throw new LogicException('ExceptionHandlingDecoratorFactory is not set.');
        }

        return $this->ExceptionHandlingDecoratorFactory;
    }

    protected function hasExceptionHandlingDecoratorFactory(): bool
    {
        return isset($this->ExceptionHandlingDecoratorFactory);
    }

    protected function unsetExceptionHandlingDecoratorFactory(): self
    {
        if (!$this->hasExceptionHandlingDecoratorFactory()) {
            throw new LogicException('ExceptionHandlingDecoratorFactory is not set.');
        }
        unset($this->ExceptionHandlingDecoratorFactory);

        return $this;
    }
}
