<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\ReschedulingV1\ReschedulingDecorator\Builder;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\ReschedulingV1\ReschedulingDecorator\BuilderInterface;

trait AwareTrait
{
    protected $WorkerV1DecoratorsReschedulingV1ReschedulingDecoratorBuilder;

    public function setWorkerV1DecoratorsReschedulingV1ReschedulingDecoratorBuilder(BuilderInterface $ReschedulingDecoratorBuilder): self
    {
        if ($this->hasWorkerV1DecoratorsReschedulingV1ReschedulingDecoratorBuilder()) {
            throw new LogicException('WorkerV1DecoratorsReschedulingV1ReschedulingDecoratorBuilder is already set.');
        }
        $this->WorkerV1DecoratorsReschedulingV1ReschedulingDecoratorBuilder = $ReschedulingDecoratorBuilder;

        return $this;
    }

    protected function getWorkerV1DecoratorsReschedulingV1ReschedulingDecoratorBuilder(): BuilderInterface
    {
        if (!$this->hasWorkerV1DecoratorsReschedulingV1ReschedulingDecoratorBuilder()) {
            throw new LogicException('WorkerV1DecoratorsReschedulingV1ReschedulingDecoratorBuilder is not set.');
        }

        return $this->WorkerV1DecoratorsReschedulingV1ReschedulingDecoratorBuilder;
    }

    protected function hasWorkerV1DecoratorsReschedulingV1ReschedulingDecoratorBuilder(): bool
    {
        return isset($this->WorkerV1DecoratorsReschedulingV1ReschedulingDecoratorBuilder);
    }

    protected function unsetWorkerV1DecoratorsReschedulingV1ReschedulingDecoratorBuilder(): self
    {
        if (!$this->hasWorkerV1DecoratorsReschedulingV1ReschedulingDecoratorBuilder()) {
            throw new LogicException('WorkerV1DecoratorsReschedulingV1ReschedulingDecoratorBuilder is not set.');
        }
        unset($this->WorkerV1DecoratorsReschedulingV1ReschedulingDecoratorBuilder);

        return $this;
    }
}
