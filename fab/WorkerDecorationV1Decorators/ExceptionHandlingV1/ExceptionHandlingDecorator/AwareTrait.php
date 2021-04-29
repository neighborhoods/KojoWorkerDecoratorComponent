<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\ExceptionHandlingV1\ExceptionHandlingDecorator;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\ExceptionHandlingV1\ExceptionHandlingDecoratorInterface;

trait AwareTrait
{
    protected $WorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecorator;

    public function setWorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecorator(ExceptionHandlingDecoratorInterface $ExceptionHandlingDecorator): self
    {
        if ($this->hasWorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecorator()) {
            throw new LogicException('WorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecorator is already set.');
        }
        $this->WorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecorator = $ExceptionHandlingDecorator;

        return $this;
    }

    protected function getWorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecorator(): ExceptionHandlingDecoratorInterface
    {
        if (!$this->hasWorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecorator()) {
            throw new LogicException('WorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecorator is not set.');
        }

        return $this->WorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecorator;
    }

    protected function hasWorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecorator(): bool
    {
        return isset($this->WorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecorator);
    }

    protected function unsetWorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecorator(): self
    {
        if (!$this->hasWorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecorator()) {
            throw new LogicException('WorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecorator is not set.');
        }
        unset($this->WorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecorator);

        return $this;
    }
}
