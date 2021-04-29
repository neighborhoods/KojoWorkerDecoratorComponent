<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\ReschedulingV1\ReschedulingDecorator\Builder;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\ReschedulingV1\ReschedulingDecorator\BuilderInterface;

trait AwareTrait
{
    protected $WorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecoratorBuilder;

    public function setWorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecoratorBuilder(BuilderInterface $ReschedulingDecoratorBuilder): self
    {
        if ($this->hasWorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecoratorBuilder()) {
            throw new LogicException('WorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecoratorBuilder is already set.');
        }
        $this->WorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecoratorBuilder = $ReschedulingDecoratorBuilder;

        return $this;
    }

    protected function getWorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecoratorBuilder(): BuilderInterface
    {
        if (!$this->hasWorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecoratorBuilder()) {
            throw new LogicException('WorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecoratorBuilder is not set.');
        }

        return $this->WorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecoratorBuilder;
    }

    protected function hasWorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecoratorBuilder(): bool
    {
        return isset($this->WorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecoratorBuilder);
    }

    protected function unsetWorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecoratorBuilder(): self
    {
        if (!$this->hasWorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecoratorBuilder()) {
            throw new LogicException('WorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecoratorBuilder is not set.');
        }
        unset($this->WorkerDecorationV1DecoratorsReschedulingV1ReschedulingDecoratorBuilder);

        return $this;
    }
}
