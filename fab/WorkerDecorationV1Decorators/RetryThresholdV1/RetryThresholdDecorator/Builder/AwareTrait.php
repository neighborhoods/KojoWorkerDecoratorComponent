<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\RetryThresholdV1\RetryThresholdDecorator\Builder;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\RetryThresholdV1\RetryThresholdDecorator\BuilderInterface;

trait AwareTrait
{
    protected $WorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilder;

    public function setWorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilder(BuilderInterface $RetryThresholdDecoratorBuilder): self
    {
        if ($this->hasWorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilder()) {
            throw new LogicException('WorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilder is already set.');
        }
        $this->WorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilder = $RetryThresholdDecoratorBuilder;

        return $this;
    }

    protected function getWorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilder(): BuilderInterface
    {
        if (!$this->hasWorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilder()) {
            throw new LogicException('WorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilder is not set.');
        }

        return $this->WorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilder;
    }

    protected function hasWorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilder(): bool
    {
        return isset($this->WorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilder);
    }

    protected function unsetWorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilder(): self
    {
        if (!$this->hasWorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilder()) {
            throw new LogicException('WorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilder is not set.');
        }
        unset($this->WorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilder);

        return $this;
    }
}
