<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\ReschedulingV1\ReschedulingDecorator;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\ReschedulingV1\ReschedulingDecoratorInterface;

trait AwareTrait
{
    protected $WorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecorator;

    public function setWorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecorator(ReschedulingDecoratorInterface $ReschedulingDecorator): self
    {
        if ($this->hasWorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecorator()) {
            throw new LogicException('WorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecorator is already set.');
        }
        $this->WorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecorator = $ReschedulingDecorator;

        return $this;
    }

    protected function getWorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecorator(): ReschedulingDecoratorInterface
    {
        if (!$this->hasWorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecorator()) {
            throw new LogicException('WorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecorator is not set.');
        }

        return $this->WorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecorator;
    }

    protected function hasWorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecorator(): bool
    {
        return isset($this->WorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecorator);
    }

    protected function unsetWorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecorator(): self
    {
        if (!$this->hasWorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecorator()) {
            throw new LogicException('WorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecorator is not set.');
        }
        unset($this->WorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecorator);

        return $this;
    }
}
