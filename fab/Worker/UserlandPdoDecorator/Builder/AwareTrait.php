<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker\UserlandPdoDecorator\Builder;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\Worker\UserlandPdoDecorator\BuilderInterface;

trait AwareTrait
{
    protected $WorkerUserlandPdoDecoratorBuilder;

    public function setWorkerUserlandPdoDecoratorBuilder(BuilderInterface $UserlandPdoDecoratorBuilder): self
    {
        if ($this->hasWorkerUserlandPdoDecoratorBuilder()) {
            throw new LogicException('WorkerUserlandPdoDecoratorBuilder is already set.');
        }
        $this->WorkerUserlandPdoDecoratorBuilder = $UserlandPdoDecoratorBuilder;

        return $this;
    }

    protected function getWorkerUserlandPdoDecoratorBuilder(): BuilderInterface
    {
        if (!$this->hasWorkerUserlandPdoDecoratorBuilder()) {
            throw new LogicException('WorkerUserlandPdoDecoratorBuilder is not set.');
        }

        return $this->WorkerUserlandPdoDecoratorBuilder;
    }

    protected function hasWorkerUserlandPdoDecoratorBuilder(): bool
    {
        return isset($this->WorkerUserlandPdoDecoratorBuilder);
    }

    protected function unsetWorkerUserlandPdoDecoratorBuilder(): self
    {
        if (!$this->hasWorkerUserlandPdoDecoratorBuilder()) {
            throw new LogicException('WorkerUserlandPdoDecoratorBuilder is not set.');
        }
        unset($this->WorkerUserlandPdoDecoratorBuilder);

        return $this;
    }
}
