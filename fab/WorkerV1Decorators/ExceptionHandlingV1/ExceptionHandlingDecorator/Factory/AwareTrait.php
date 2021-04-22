<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\ExceptionHandlingV1\ExceptionHandlingDecorator\Factory;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\ExceptionHandlingV1\ExceptionHandlingDecorator\FactoryInterface;

trait AwareTrait
{
    protected $WorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorFactory;

    public function setWorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorFactory(FactoryInterface $ExceptionHandlingDecoratorFactory): self
    {
        if ($this->hasWorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorFactory()) {
            throw new LogicException('WorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorFactory is already set.');
        }
        $this->WorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorFactory = $ExceptionHandlingDecoratorFactory;

        return $this;
    }

    protected function getWorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorFactory(): FactoryInterface
    {
        if (!$this->hasWorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorFactory()) {
            throw new LogicException('WorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorFactory is not set.');
        }

        return $this->WorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorFactory;
    }

    protected function hasWorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorFactory(): bool
    {
        return isset($this->WorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorFactory);
    }

    protected function unsetWorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorFactory(): self
    {
        if (!$this->hasWorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorFactory()) {
            throw new LogicException('WorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorFactory is not set.');
        }
        unset($this->WorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorFactory);

        return $this;
    }
}
