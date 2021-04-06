<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker\ReschedulingDecorator\Builder;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\Worker\ReschedulingDecorator\BuilderInterface;

trait AwareTrait
{
    protected $WorkerReschedulingDecoratorBuilder;

    public function setWorkerReschedulingDecoratorBuilder(BuilderInterface $ReschedulingDecoratorBuilder): self
    {
        if ($this->hasWorkerReschedulingDecoratorBuilder()) {
            throw new LogicException('WorkerReschedulingDecoratorBuilder is already set.');
        }
        $this->WorkerReschedulingDecoratorBuilder = $ReschedulingDecoratorBuilder;

        return $this;
    }

    protected function getWorkerReschedulingDecoratorBuilder(): BuilderInterface
    {
        if (!$this->hasWorkerReschedulingDecoratorBuilder()) {
            throw new LogicException('WorkerReschedulingDecoratorBuilder is not set.');
        }

        return $this->WorkerReschedulingDecoratorBuilder;
    }

    protected function hasWorkerReschedulingDecoratorBuilder(): bool
    {
        return isset($this->WorkerReschedulingDecoratorBuilder);
    }

    protected function unsetWorkerReschedulingDecoratorBuilder(): self
    {
        if (!$this->hasWorkerReschedulingDecoratorBuilder()) {
            throw new LogicException('WorkerReschedulingDecoratorBuilder is not set.');
        }
        unset($this->WorkerReschedulingDecoratorBuilder);

        return $this;
    }
}
