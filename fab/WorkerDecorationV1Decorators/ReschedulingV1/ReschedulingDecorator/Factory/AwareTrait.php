<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\ReschedulingV1\ReschedulingDecorator\Factory;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\ReschedulingV1\ReschedulingDecorator\FactoryInterface;

trait AwareTrait
{
    protected $WorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecoratorFactory;

    public function setWorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecoratorFactory(FactoryInterface $ReschedulingDecoratorFactory): self
    {
        if ($this->hasWorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecoratorFactory()) {
            throw new LogicException('WorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecoratorFactory is already set.');
        }
        $this->WorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecoratorFactory = $ReschedulingDecoratorFactory;

        return $this;
    }

    protected function getWorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecoratorFactory(): FactoryInterface
    {
        if (!$this->hasWorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecoratorFactory()) {
            throw new LogicException('WorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecoratorFactory is not set.');
        }

        return $this->WorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecoratorFactory;
    }

    protected function hasWorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecoratorFactory(): bool
    {
        return isset($this->WorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecoratorFactory);
    }

    protected function unsetWorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecoratorFactory(): self
    {
        if (!$this->hasWorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecoratorFactory()) {
            throw new LogicException('WorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecoratorFactory is not set.');
        }
        unset($this->WorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecoratorFactory);

        return $this;
    }
}
