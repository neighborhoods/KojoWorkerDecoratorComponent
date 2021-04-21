<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\ReschedulingV1\ReschedulingDecorator\Builder;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\ReschedulingV1\ReschedulingDecorator\BuilderInterface;

trait AwareTrait
{
    protected $ReschedulingDecoratorBuilder;

    public function setReschedulingDecoratorBuilder(BuilderInterface $ReschedulingDecoratorBuilder): self
    {
        if ($this->hasReschedulingDecoratorBuilder()) {
            throw new LogicException('ReschedulingDecoratorBuilder is already set.');
        }
        $this->ReschedulingDecoratorBuilder = $ReschedulingDecoratorBuilder;

        return $this;
    }

    protected function getReschedulingDecoratorBuilder(): BuilderInterface
    {
        if (!$this->hasReschedulingDecoratorBuilder()) {
            throw new LogicException('ReschedulingDecoratorBuilder is not set.');
        }

        return $this->ReschedulingDecoratorBuilder;
    }

    protected function hasReschedulingDecoratorBuilder(): bool
    {
        return isset($this->ReschedulingDecoratorBuilder);
    }

    protected function unsetReschedulingDecoratorBuilder(): self
    {
        if (!$this->hasReschedulingDecoratorBuilder()) {
            throw new LogicException('ReschedulingDecoratorBuilder is not set.');
        }
        unset($this->ReschedulingDecoratorBuilder);

        return $this;
    }
}
