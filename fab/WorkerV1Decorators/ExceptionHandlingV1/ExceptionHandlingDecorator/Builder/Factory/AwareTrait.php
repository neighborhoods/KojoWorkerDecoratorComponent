<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\ExceptionHandlingV1\ExceptionHandlingDecorator\Builder\Factory;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\ExceptionHandlingV1\ExceptionHandlingDecorator\Builder\FactoryInterface;

trait AwareTrait
{
    protected $WorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilderFactory;

    public function setWorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilderFactory(FactoryInterface $ExceptionHandlingDecoratorBuilderFactory): self
    {
        if ($this->hasWorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilderFactory()) {
            throw new LogicException('WorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilderFactory is already set.');
        }
        $this->WorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilderFactory = $ExceptionHandlingDecoratorBuilderFactory;

        return $this;
    }

    protected function getWorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilderFactory(): FactoryInterface
    {
        if (!$this->hasWorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilderFactory()) {
            throw new LogicException('WorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilderFactory is not set.');
        }

        return $this->WorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilderFactory;
    }

    protected function hasWorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilderFactory(): bool
    {
        return isset($this->WorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilderFactory);
    }

    protected function unsetWorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilderFactory(): self
    {
        if (!$this->hasWorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilderFactory()) {
            throw new LogicException('WorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilderFactory is not set.');
        }
        unset($this->WorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilderFactory);

        return $this;
    }
}
