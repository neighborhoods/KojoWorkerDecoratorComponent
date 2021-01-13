<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker\ExceptionHandlingDecorator\Builder;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\Worker\ExceptionHandlingDecorator\BuilderInterface;

trait AwareTrait
{
    protected $WorkerExceptionHandlingDecoratorBuilder;

    public function setWorkerExceptionHandlingDecoratorBuilder(BuilderInterface $ExceptionHandlingDecoratorBuilder): self
    {
        if ($this->hasWorkerExceptionHandlingDecoratorBuilder()) {
            throw new LogicException('WorkerExceptionHandlingDecoratorBuilder is already set.');
        }
        $this->WorkerExceptionHandlingDecoratorBuilder = $ExceptionHandlingDecoratorBuilder;

        return $this;
    }

    protected function getWorkerExceptionHandlingDecoratorBuilder(): BuilderInterface
    {
        if (!$this->hasWorkerExceptionHandlingDecoratorBuilder()) {
            throw new LogicException('WorkerExceptionHandlingDecoratorBuilder is not set.');
        }

        return $this->WorkerExceptionHandlingDecoratorBuilder;
    }

    protected function hasWorkerExceptionHandlingDecoratorBuilder(): bool
    {
        return isset($this->WorkerExceptionHandlingDecoratorBuilder);
    }

    protected function unsetWorkerExceptionHandlingDecoratorBuilder(): self
    {
        if (!$this->hasWorkerExceptionHandlingDecoratorBuilder()) {
            throw new LogicException('WorkerExceptionHandlingDecoratorBuilder is not set.');
        }
        unset($this->WorkerExceptionHandlingDecoratorBuilder);

        return $this;
    }
}
