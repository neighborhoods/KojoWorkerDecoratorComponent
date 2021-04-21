<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\ReschedulingV1\ReschedulingDecorator;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\ReschedulingV1\ReschedulingDecoratorInterface;

trait AwareTrait
{
    protected $ReschedulingDecorator;

    public function setReschedulingDecorator(ReschedulingDecoratorInterface $ReschedulingDecorator): self
    {
        if ($this->hasReschedulingDecorator()) {
            throw new LogicException('ReschedulingDecorator is already set.');
        }
        $this->ReschedulingDecorator = $ReschedulingDecorator;

        return $this;
    }

    protected function getReschedulingDecorator(): ReschedulingDecoratorInterface
    {
        if (!$this->hasReschedulingDecorator()) {
            throw new LogicException('ReschedulingDecorator is not set.');
        }

        return $this->ReschedulingDecorator;
    }

    protected function hasReschedulingDecorator(): bool
    {
        return isset($this->ReschedulingDecorator);
    }

    protected function unsetReschedulingDecorator(): self
    {
        if (!$this->hasReschedulingDecorator()) {
            throw new LogicException('ReschedulingDecorator is not set.');
        }
        unset($this->ReschedulingDecorator);

        return $this;
    }
}
