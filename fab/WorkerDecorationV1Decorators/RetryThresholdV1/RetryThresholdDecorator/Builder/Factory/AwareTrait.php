<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\RetryThresholdV1\RetryThresholdDecorator\Builder\Factory;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\RetryThresholdV1\RetryThresholdDecorator\Builder\FactoryInterface;

trait AwareTrait
{
    protected $WorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilderFactory;

    public function setWorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilderFactory(FactoryInterface $RetryThresholdDecoratorBuilderFactory): self
    {
        if ($this->hasWorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilderFactory()) {
            throw new LogicException('WorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilderFactory is already set.');
        }
        $this->WorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilderFactory = $RetryThresholdDecoratorBuilderFactory;

        return $this;
    }

    protected function getWorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilderFactory(): FactoryInterface
    {
        if (!$this->hasWorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilderFactory()) {
            throw new LogicException('WorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilderFactory is not set.');
        }

        return $this->WorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilderFactory;
    }

    protected function hasWorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilderFactory(): bool
    {
        return isset($this->WorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilderFactory);
    }

    protected function unsetWorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilderFactory(): self
    {
        if (!$this->hasWorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilderFactory()) {
            throw new LogicException('WorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilderFactory is not set.');
        }
        unset($this->WorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilderFactory);

        return $this;
    }
}
