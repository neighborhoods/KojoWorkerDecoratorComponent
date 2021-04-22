<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\ReschedulingV1\ReschedulingDecorator\Builder\Factory;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\ReschedulingV1\ReschedulingDecorator\Builder\FactoryInterface;

trait AwareTrait
{
    protected $WorkerV1DecoratorsReschedulingV1ReschedulingDecoratorBuilderFactory;

    public function setWorkerV1DecoratorsReschedulingV1ReschedulingDecoratorBuilderFactory(FactoryInterface $ReschedulingDecoratorBuilderFactory): self
    {
        if ($this->hasWorkerV1DecoratorsReschedulingV1ReschedulingDecoratorBuilderFactory()) {
            throw new LogicException('WorkerV1DecoratorsReschedulingV1ReschedulingDecoratorBuilderFactory is already set.');
        }
        $this->WorkerV1DecoratorsReschedulingV1ReschedulingDecoratorBuilderFactory = $ReschedulingDecoratorBuilderFactory;

        return $this;
    }

    protected function getWorkerV1DecoratorsReschedulingV1ReschedulingDecoratorBuilderFactory(): FactoryInterface
    {
        if (!$this->hasWorkerV1DecoratorsReschedulingV1ReschedulingDecoratorBuilderFactory()) {
            throw new LogicException('WorkerV1DecoratorsReschedulingV1ReschedulingDecoratorBuilderFactory is not set.');
        }

        return $this->WorkerV1DecoratorsReschedulingV1ReschedulingDecoratorBuilderFactory;
    }

    protected function hasWorkerV1DecoratorsReschedulingV1ReschedulingDecoratorBuilderFactory(): bool
    {
        return isset($this->WorkerV1DecoratorsReschedulingV1ReschedulingDecoratorBuilderFactory);
    }

    protected function unsetWorkerV1DecoratorsReschedulingV1ReschedulingDecoratorBuilderFactory(): self
    {
        if (!$this->hasWorkerV1DecoratorsReschedulingV1ReschedulingDecoratorBuilderFactory()) {
            throw new LogicException('WorkerV1DecoratorsReschedulingV1ReschedulingDecoratorBuilderFactory is not set.');
        }
        unset($this->WorkerV1DecoratorsReschedulingV1ReschedulingDecoratorBuilderFactory);

        return $this;
    }
}
