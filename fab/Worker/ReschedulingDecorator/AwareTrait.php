<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker\ReschedulingDecorator;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\Worker\ReschedulingDecoratorInterface;

trait AwareTrait
{
    protected $WorkerReschedulingDecorator;

    public function setWorkerReschedulingDecorator(ReschedulingDecoratorInterface $ReschedulingDecorator): self
    {
        if ($this->hasWorkerReschedulingDecorator()) {
            throw new LogicException('WorkerReschedulingDecorator is already set.');
        }
        $this->WorkerReschedulingDecorator = $ReschedulingDecorator;

        return $this;
    }

    protected function getWorkerReschedulingDecorator(): ReschedulingDecoratorInterface
    {
        if (!$this->hasWorkerReschedulingDecorator()) {
            throw new LogicException('WorkerReschedulingDecorator is not set.');
        }

        return $this->WorkerReschedulingDecorator;
    }

    protected function hasWorkerReschedulingDecorator(): bool
    {
        return isset($this->WorkerReschedulingDecorator);
    }

    protected function unsetWorkerReschedulingDecorator(): self
    {
        if (!$this->hasWorkerReschedulingDecorator()) {
            throw new LogicException('WorkerReschedulingDecorator is not set.');
        }
        unset($this->WorkerReschedulingDecorator);

        return $this;
    }
}
