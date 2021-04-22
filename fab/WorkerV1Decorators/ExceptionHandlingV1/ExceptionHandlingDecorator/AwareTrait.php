<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\ExceptionHandlingV1\ExceptionHandlingDecorator;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\ExceptionHandlingV1\ExceptionHandlingDecoratorInterface;

trait AwareTrait
{
    protected $WorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecorator;

    public function setWorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecorator(ExceptionHandlingDecoratorInterface $ExceptionHandlingDecorator): self
    {
        if ($this->hasWorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecorator()) {
            throw new LogicException('WorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecorator is already set.');
        }
        $this->WorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecorator = $ExceptionHandlingDecorator;

        return $this;
    }

    protected function getWorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecorator(): ExceptionHandlingDecoratorInterface
    {
        if (!$this->hasWorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecorator()) {
            throw new LogicException('WorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecorator is not set.');
        }

        return $this->WorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecorator;
    }

    protected function hasWorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecorator(): bool
    {
        return isset($this->WorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecorator);
    }

    protected function unsetWorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecorator(): self
    {
        if (!$this->hasWorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecorator()) {
            throw new LogicException('WorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecorator is not set.');
        }
        unset($this->WorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecorator);

        return $this;
    }
}
