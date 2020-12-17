<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker\ExceptionHandlingDecorator;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\Worker\ExceptionHandlingDecoratorInterface;

trait AwareTrait
{
    protected $WorkerExceptionHandlingDecorator;

    public function setWorkerExceptionHandlingDecorator(ExceptionHandlingDecoratorInterface $ExceptionHandlingDecorator): self
    {
        if ($this->hasWorkerExceptionHandlingDecorator()) {
            throw new LogicException('WorkerExceptionHandlingDecorator is already set.');
        }
        $this->WorkerExceptionHandlingDecorator = $ExceptionHandlingDecorator;

        return $this;
    }

    protected function getWorkerExceptionHandlingDecorator(): ExceptionHandlingDecoratorInterface
    {
        if (!$this->hasWorkerExceptionHandlingDecorator()) {
            throw new LogicException('WorkerExceptionHandlingDecorator is not set.');
        }

        return $this->WorkerExceptionHandlingDecorator;
    }

    protected function hasWorkerExceptionHandlingDecorator(): bool
    {
        return isset($this->WorkerExceptionHandlingDecorator);
    }

    protected function unsetWorkerExceptionHandlingDecorator(): self
    {
        if (!$this->hasWorkerExceptionHandlingDecorator()) {
            throw new LogicException('WorkerExceptionHandlingDecorator is not set.');
        }
        unset($this->WorkerExceptionHandlingDecorator);

        return $this;
    }
}
