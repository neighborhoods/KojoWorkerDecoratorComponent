<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\ExceptionHandlingV1\ExceptionHandlingDecorator\Builder;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\ExceptionHandlingV1\ExceptionHandlingDecorator\BuilderInterface;

trait AwareTrait
{
    protected $ExceptionHandlingDecoratorBuilder;

    public function setExceptionHandlingDecoratorBuilder(BuilderInterface $ExceptionHandlingDecoratorBuilder): self
    {
        if ($this->hasExceptionHandlingDecoratorBuilder()) {
            throw new LogicException('ExceptionHandlingDecoratorBuilder is already set.');
        }
        $this->ExceptionHandlingDecoratorBuilder = $ExceptionHandlingDecoratorBuilder;

        return $this;
    }

    protected function getExceptionHandlingDecoratorBuilder(): BuilderInterface
    {
        if (!$this->hasExceptionHandlingDecoratorBuilder()) {
            throw new LogicException('ExceptionHandlingDecoratorBuilder is not set.');
        }

        return $this->ExceptionHandlingDecoratorBuilder;
    }

    protected function hasExceptionHandlingDecoratorBuilder(): bool
    {
        return isset($this->ExceptionHandlingDecoratorBuilder);
    }

    protected function unsetExceptionHandlingDecoratorBuilder(): self
    {
        if (!$this->hasExceptionHandlingDecoratorBuilder()) {
            throw new LogicException('ExceptionHandlingDecoratorBuilder is not set.');
        }
        unset($this->ExceptionHandlingDecoratorBuilder);

        return $this;
    }
}
