<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\ReschedulingV1\ReschedulingDecorator\Builder\Factory;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\ReschedulingV1\ReschedulingDecorator\Builder\FactoryInterface;

trait AwareTrait
{
    protected $WorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecoratorBuilderFactory;

    public function setWorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecoratorBuilderFactory(FactoryInterface $ReschedulingDecoratorBuilderFactory): self
    {
        if ($this->hasWorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecoratorBuilderFactory()) {
            throw new LogicException('WorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecoratorBuilderFactory is already set.');
        }
        $this->WorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecoratorBuilderFactory = $ReschedulingDecoratorBuilderFactory;

        return $this;
    }

    protected function getWorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecoratorBuilderFactory(): FactoryInterface
    {
        if (!$this->hasWorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecoratorBuilderFactory()) {
            throw new LogicException('WorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecoratorBuilderFactory is not set.');
        }

        return $this->WorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecoratorBuilderFactory;
    }

    protected function hasWorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecoratorBuilderFactory(): bool
    {
        return isset($this->WorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecoratorBuilderFactory);
    }

    protected function unsetWorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecoratorBuilderFactory(): self
    {
        if (!$this->hasWorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecoratorBuilderFactory()) {
            throw new LogicException('WorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecoratorBuilderFactory is not set.');
        }
        unset($this->WorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecoratorBuilderFactory);

        return $this;
    }
}
