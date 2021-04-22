<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\ExceptionHandlingV1\ExceptionHandlingDecorator\Builder;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\ExceptionHandlingV1\ExceptionHandlingDecorator\BuilderInterface;

trait AwareTrait
{
    protected $WorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilder;

    public function setWorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilder(BuilderInterface $ExceptionHandlingDecoratorBuilder): self
    {
        if ($this->hasWorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilder()) {
            throw new LogicException('WorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilder is already set.');
        }
        $this->WorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilder = $ExceptionHandlingDecoratorBuilder;

        return $this;
    }

    protected function getWorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilder(): BuilderInterface
    {
        if (!$this->hasWorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilder()) {
            throw new LogicException('WorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilder is not set.');
        }

        return $this->WorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilder;
    }

    protected function hasWorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilder(): bool
    {
        return isset($this->WorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilder);
    }

    protected function unsetWorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilder(): self
    {
        if (!$this->hasWorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilder()) {
            throw new LogicException('WorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilder is not set.');
        }
        unset($this->WorkerV1DecoratorsExceptionHandlingV1ExceptionHandlingDecoratorBuilder);

        return $this;
    }
}
