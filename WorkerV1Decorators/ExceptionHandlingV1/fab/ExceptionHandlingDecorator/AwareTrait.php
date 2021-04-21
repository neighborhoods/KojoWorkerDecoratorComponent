<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\ExceptionHandlingV1\ExceptionHandlingDecorator;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\ExceptionHandlingV1\ExceptionHandlingDecoratorInterface;

trait AwareTrait
{
    protected $ExceptionHandlingDecorator;

    public function setExceptionHandlingDecorator(ExceptionHandlingDecoratorInterface $ExceptionHandlingDecorator): self
    {
        if ($this->hasExceptionHandlingDecorator()) {
            throw new LogicException('ExceptionHandlingDecorator is already set.');
        }
        $this->ExceptionHandlingDecorator = $ExceptionHandlingDecorator;

        return $this;
    }

    protected function getExceptionHandlingDecorator(): ExceptionHandlingDecoratorInterface
    {
        if (!$this->hasExceptionHandlingDecorator()) {
            throw new LogicException('ExceptionHandlingDecorator is not set.');
        }

        return $this->ExceptionHandlingDecorator;
    }

    protected function hasExceptionHandlingDecorator(): bool
    {
        return isset($this->ExceptionHandlingDecorator);
    }

    protected function unsetExceptionHandlingDecorator(): self
    {
        if (!$this->hasExceptionHandlingDecorator()) {
            throw new LogicException('ExceptionHandlingDecorator is not set.');
        }
        unset($this->ExceptionHandlingDecorator);

        return $this;
    }
}
