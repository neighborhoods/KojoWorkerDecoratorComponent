<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\ExceptionHandlingV1\ExceptionHandlingDecorator\Builder\Factory;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\ExceptionHandlingV1\ExceptionHandlingDecorator\Builder\FactoryInterface;

trait AwareTrait
{
    protected $ExceptionHandlingDecoratorBuilderFactory;

    public function setExceptionHandlingDecoratorBuilderFactory(FactoryInterface $ExceptionHandlingDecoratorBuilderFactory): self
    {
        if ($this->hasExceptionHandlingDecoratorBuilderFactory()) {
            throw new LogicException('ExceptionHandlingDecoratorBuilderFactory is already set.');
        }
        $this->ExceptionHandlingDecoratorBuilderFactory = $ExceptionHandlingDecoratorBuilderFactory;

        return $this;
    }

    protected function getExceptionHandlingDecoratorBuilderFactory(): FactoryInterface
    {
        if (!$this->hasExceptionHandlingDecoratorBuilderFactory()) {
            throw new LogicException('ExceptionHandlingDecoratorBuilderFactory is not set.');
        }

        return $this->ExceptionHandlingDecoratorBuilderFactory;
    }

    protected function hasExceptionHandlingDecoratorBuilderFactory(): bool
    {
        return isset($this->ExceptionHandlingDecoratorBuilderFactory);
    }

    protected function unsetExceptionHandlingDecoratorBuilderFactory(): self
    {
        if (!$this->hasExceptionHandlingDecoratorBuilderFactory()) {
            throw new LogicException('ExceptionHandlingDecoratorBuilderFactory is not set.');
        }
        unset($this->ExceptionHandlingDecoratorBuilderFactory);

        return $this;
    }
}
