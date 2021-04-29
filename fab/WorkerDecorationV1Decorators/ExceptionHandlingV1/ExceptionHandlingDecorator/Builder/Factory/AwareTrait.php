<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\ExceptionHandlingV1\ExceptionHandlingDecorator\Builder\Factory;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\ExceptionHandlingV1\ExceptionHandlingDecorator\Builder\FactoryInterface;

trait AwareTrait
{
    protected $WorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilderFactory;

    public function setWorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilderFactory(FactoryInterface $ExceptionHandlingDecoratorBuilderFactory): self
    {
        if ($this->hasWorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilderFactory()) {
            throw new LogicException('WorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilderFactory is already set.');
        }
        $this->WorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilderFactory = $ExceptionHandlingDecoratorBuilderFactory;

        return $this;
    }

    protected function getWorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilderFactory(): FactoryInterface
    {
        if (!$this->hasWorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilderFactory()) {
            throw new LogicException('WorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilderFactory is not set.');
        }

        return $this->WorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilderFactory;
    }

    protected function hasWorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilderFactory(): bool
    {
        return isset($this->WorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilderFactory);
    }

    protected function unsetWorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilderFactory(): self
    {
        if (!$this->hasWorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilderFactory()) {
            throw new LogicException('WorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilderFactory is not set.');
        }
        unset($this->WorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilderFactory);

        return $this;
    }
}
