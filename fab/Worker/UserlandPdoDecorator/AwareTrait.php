<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker\UserlandPdoDecorator;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\Worker\UserlandPdoDecoratorInterface;

trait AwareTrait
{
    protected $WorkerUserlandPdoDecorator;

    public function setWorkerUserlandPdoDecorator(UserlandPdoDecoratorInterface $UserlandPdoDecorator): self
    {
        if ($this->hasWorkerUserlandPdoDecorator()) {
            throw new LogicException('WorkerUserlandPdoDecorator is already set.');
        }
        $this->WorkerUserlandPdoDecorator = $UserlandPdoDecorator;

        return $this;
    }

    protected function getWorkerUserlandPdoDecorator(): UserlandPdoDecoratorInterface
    {
        if (!$this->hasWorkerUserlandPdoDecorator()) {
            throw new LogicException('WorkerUserlandPdoDecorator is not set.');
        }

        return $this->WorkerUserlandPdoDecorator;
    }

    protected function hasWorkerUserlandPdoDecorator(): bool
    {
        return isset($this->WorkerUserlandPdoDecorator);
    }

    protected function unsetWorkerUserlandPdoDecorator(): self
    {
        if (!$this->hasWorkerUserlandPdoDecorator()) {
            throw new LogicException('WorkerUserlandPdoDecorator is not set.');
        }
        unset($this->WorkerUserlandPdoDecorator);

        return $this;
    }
}
