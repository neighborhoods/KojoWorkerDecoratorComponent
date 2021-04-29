<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\ExceptionHandlingV1\ExceptionHandlingDecorator\Factory;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\ExceptionHandlingV1\ExceptionHandlingDecorator\FactoryInterface;

trait AwareTrait
{
    protected $WorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorFactory;

    public function setWorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorFactory(FactoryInterface $ExceptionHandlingDecoratorFactory): self
    {
        if ($this->hasWorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorFactory()) {
            throw new LogicException('WorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorFactory is already set.');
        }
        $this->WorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorFactory = $ExceptionHandlingDecoratorFactory;

        return $this;
    }

    protected function getWorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorFactory(): FactoryInterface
    {
        if (!$this->hasWorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorFactory()) {
            throw new LogicException('WorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorFactory is not set.');
        }

        return $this->WorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorFactory;
    }

    protected function hasWorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorFactory(): bool
    {
        return isset($this->WorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorFactory);
    }

    protected function unsetWorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorFactory(): self
    {
        if (!$this->hasWorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorFactory()) {
            throw new LogicException('WorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorFactory is not set.');
        }
        unset($this->WorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorFactory);

        return $this;
    }
}
