<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\RetryThresholdV1\RetryThresholdDecorator\Factory;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\RetryThresholdV1\RetryThresholdDecorator\FactoryInterface;

trait AwareTrait
{
    protected $WorkerV1DecoratorsRetryThresholdV1RetryThresholdDecoratorFactory;

    public function setWorkerV1DecoratorsRetryThresholdV1RetryThresholdDecoratorFactory(FactoryInterface $RetryThresholdDecoratorFactory): self
    {
        if ($this->hasWorkerV1DecoratorsRetryThresholdV1RetryThresholdDecoratorFactory()) {
            throw new LogicException('WorkerV1DecoratorsRetryThresholdV1RetryThresholdDecoratorFactory is already set.');
        }
        $this->WorkerV1DecoratorsRetryThresholdV1RetryThresholdDecoratorFactory = $RetryThresholdDecoratorFactory;

        return $this;
    }

    protected function getWorkerV1DecoratorsRetryThresholdV1RetryThresholdDecoratorFactory(): FactoryInterface
    {
        if (!$this->hasWorkerV1DecoratorsRetryThresholdV1RetryThresholdDecoratorFactory()) {
            throw new LogicException('WorkerV1DecoratorsRetryThresholdV1RetryThresholdDecoratorFactory is not set.');
        }

        return $this->WorkerV1DecoratorsRetryThresholdV1RetryThresholdDecoratorFactory;
    }

    protected function hasWorkerV1DecoratorsRetryThresholdV1RetryThresholdDecoratorFactory(): bool
    {
        return isset($this->WorkerV1DecoratorsRetryThresholdV1RetryThresholdDecoratorFactory);
    }

    protected function unsetWorkerV1DecoratorsRetryThresholdV1RetryThresholdDecoratorFactory(): self
    {
        if (!$this->hasWorkerV1DecoratorsRetryThresholdV1RetryThresholdDecoratorFactory()) {
            throw new LogicException('WorkerV1DecoratorsRetryThresholdV1RetryThresholdDecoratorFactory is not set.');
        }
        unset($this->WorkerV1DecoratorsRetryThresholdV1RetryThresholdDecoratorFactory);

        return $this;
    }
}
