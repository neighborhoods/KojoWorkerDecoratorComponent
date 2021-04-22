<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\RetryThresholdV1\RetryThresholdDecorator\Builder\Factory;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\RetryThresholdV1\RetryThresholdDecorator\Builder\FactoryInterface;

trait AwareTrait
{
    protected $WorkerV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilderFactory;

    public function setWorkerV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilderFactory(FactoryInterface $RetryThresholdDecoratorBuilderFactory): self
    {
        if ($this->hasWorkerV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilderFactory()) {
            throw new LogicException('WorkerV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilderFactory is already set.');
        }
        $this->WorkerV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilderFactory = $RetryThresholdDecoratorBuilderFactory;

        return $this;
    }

    protected function getWorkerV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilderFactory(): FactoryInterface
    {
        if (!$this->hasWorkerV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilderFactory()) {
            throw new LogicException('WorkerV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilderFactory is not set.');
        }

        return $this->WorkerV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilderFactory;
    }

    protected function hasWorkerV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilderFactory(): bool
    {
        return isset($this->WorkerV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilderFactory);
    }

    protected function unsetWorkerV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilderFactory(): self
    {
        if (!$this->hasWorkerV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilderFactory()) {
            throw new LogicException('WorkerV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilderFactory is not set.');
        }
        unset($this->WorkerV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilderFactory);

        return $this;
    }
}
