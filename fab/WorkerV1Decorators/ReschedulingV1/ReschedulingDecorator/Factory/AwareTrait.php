<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\ReschedulingV1\ReschedulingDecorator\Factory;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\ReschedulingV1\ReschedulingDecorator\FactoryInterface;

trait AwareTrait
{
    protected $WorkerV1DecoratorsReschedulingV1ReschedulingDecoratorFactory;

    public function setWorkerV1DecoratorsReschedulingV1ReschedulingDecoratorFactory(FactoryInterface $ReschedulingDecoratorFactory): self
    {
        if ($this->hasWorkerV1DecoratorsReschedulingV1ReschedulingDecoratorFactory()) {
            throw new LogicException('WorkerV1DecoratorsReschedulingV1ReschedulingDecoratorFactory is already set.');
        }
        $this->WorkerV1DecoratorsReschedulingV1ReschedulingDecoratorFactory = $ReschedulingDecoratorFactory;

        return $this;
    }

    protected function getWorkerV1DecoratorsReschedulingV1ReschedulingDecoratorFactory(): FactoryInterface
    {
        if (!$this->hasWorkerV1DecoratorsReschedulingV1ReschedulingDecoratorFactory()) {
            throw new LogicException('WorkerV1DecoratorsReschedulingV1ReschedulingDecoratorFactory is not set.');
        }

        return $this->WorkerV1DecoratorsReschedulingV1ReschedulingDecoratorFactory;
    }

    protected function hasWorkerV1DecoratorsReschedulingV1ReschedulingDecoratorFactory(): bool
    {
        return isset($this->WorkerV1DecoratorsReschedulingV1ReschedulingDecoratorFactory);
    }

    protected function unsetWorkerV1DecoratorsReschedulingV1ReschedulingDecoratorFactory(): self
    {
        if (!$this->hasWorkerV1DecoratorsReschedulingV1ReschedulingDecoratorFactory()) {
            throw new LogicException('WorkerV1DecoratorsReschedulingV1ReschedulingDecoratorFactory is not set.');
        }
        unset($this->WorkerV1DecoratorsReschedulingV1ReschedulingDecoratorFactory);

        return $this;
    }
}
