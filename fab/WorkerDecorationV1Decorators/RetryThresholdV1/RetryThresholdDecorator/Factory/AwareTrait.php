<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\RetryThresholdV1\RetryThresholdDecorator\Factory;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\RetryThresholdV1\RetryThresholdDecorator\FactoryInterface;

trait AwareTrait
{
    protected $WorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecoratorFactory;

    public function setWorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecoratorFactory(FactoryInterface $RetryThresholdDecoratorFactory): self
    {
        if ($this->hasWorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecoratorFactory()) {
            throw new LogicException('WorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecoratorFactory is already set.');
        }
        $this->WorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecoratorFactory = $RetryThresholdDecoratorFactory;

        return $this;
    }

    protected function getWorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecoratorFactory(): FactoryInterface
    {
        if (!$this->hasWorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecoratorFactory()) {
            throw new LogicException('WorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecoratorFactory is not set.');
        }

        return $this->WorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecoratorFactory;
    }

    protected function hasWorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecoratorFactory(): bool
    {
        return isset($this->WorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecoratorFactory);
    }

    protected function unsetWorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecoratorFactory(): self
    {
        if (!$this->hasWorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecoratorFactory()) {
            throw new LogicException('WorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecoratorFactory is not set.');
        }
        unset($this->WorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecoratorFactory);

        return $this;
    }
}
