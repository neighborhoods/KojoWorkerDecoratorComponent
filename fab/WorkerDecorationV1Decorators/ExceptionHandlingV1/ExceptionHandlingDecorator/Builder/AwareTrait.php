<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\ExceptionHandlingV1\ExceptionHandlingDecorator\Builder;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\ExceptionHandlingV1\ExceptionHandlingDecorator\BuilderInterface;

trait AwareTrait
{
    protected $WorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilder;

    public function setWorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilder(BuilderInterface $ExceptionHandlingDecoratorBuilder): self
    {
        if ($this->hasWorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilder()) {
            throw new LogicException('WorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilder is already set.');
        }
        $this->WorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilder = $ExceptionHandlingDecoratorBuilder;

        return $this;
    }

    protected function getWorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilder(): BuilderInterface
    {
        if (!$this->hasWorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilder()) {
            throw new LogicException('WorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilder is not set.');
        }

        return $this->WorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilder;
    }

    protected function hasWorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilder(): bool
    {
        return isset($this->WorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilder);
    }

    protected function unsetWorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilder(): self
    {
        if (!$this->hasWorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilder()) {
            throw new LogicException('WorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilder is not set.');
        }
        unset($this->WorkerDecorationV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilder);

        return $this;
    }
}
