<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\ReschedulingV1\ReschedulingDecorator;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\ReschedulingV1\ReschedulingDecoratorInterface;

trait AwareTrait
{
    protected $WorkerV1DecoratorsReschedulingV1ReschedulingDecorator;

    public function setWorkerV1DecoratorsReschedulingV1ReschedulingDecorator(ReschedulingDecoratorInterface $ReschedulingDecorator): self
    {
        if ($this->hasWorkerV1DecoratorsReschedulingV1ReschedulingDecorator()) {
            throw new LogicException('WorkerV1DecoratorsReschedulingV1ReschedulingDecorator is already set.');
        }
        $this->WorkerV1DecoratorsReschedulingV1ReschedulingDecorator = $ReschedulingDecorator;

        return $this;
    }

    protected function getWorkerV1DecoratorsReschedulingV1ReschedulingDecorator(): ReschedulingDecoratorInterface
    {
        if (!$this->hasWorkerV1DecoratorsReschedulingV1ReschedulingDecorator()) {
            throw new LogicException('WorkerV1DecoratorsReschedulingV1ReschedulingDecorator is not set.');
        }

        return $this->WorkerV1DecoratorsReschedulingV1ReschedulingDecorator;
    }

    protected function hasWorkerV1DecoratorsReschedulingV1ReschedulingDecorator(): bool
    {
        return isset($this->WorkerV1DecoratorsReschedulingV1ReschedulingDecorator);
    }

    protected function unsetWorkerV1DecoratorsReschedulingV1ReschedulingDecorator(): self
    {
        if (!$this->hasWorkerV1DecoratorsReschedulingV1ReschedulingDecorator()) {
            throw new LogicException('WorkerV1DecoratorsReschedulingV1ReschedulingDecorator is not set.');
        }
        unset($this->WorkerV1DecoratorsReschedulingV1ReschedulingDecorator);

        return $this;
    }
}
