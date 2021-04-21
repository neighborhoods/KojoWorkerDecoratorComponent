<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\RetryThresholdV1\RetryThresholdDecorator\Builder\Factory;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\RetryThresholdV1\RetryThresholdDecorator\Builder\FactoryInterface;

trait AwareTrait
{
    protected $RetryThresholdDecoratorBuilderFactory;

    public function setRetryThresholdDecoratorBuilderFactory(FactoryInterface $RetryThresholdDecoratorBuilderFactory): self
    {
        if ($this->hasRetryThresholdDecoratorBuilderFactory()) {
            throw new LogicException('RetryThresholdDecoratorBuilderFactory is already set.');
        }
        $this->RetryThresholdDecoratorBuilderFactory = $RetryThresholdDecoratorBuilderFactory;

        return $this;
    }

    protected function getRetryThresholdDecoratorBuilderFactory(): FactoryInterface
    {
        if (!$this->hasRetryThresholdDecoratorBuilderFactory()) {
            throw new LogicException('RetryThresholdDecoratorBuilderFactory is not set.');
        }

        return $this->RetryThresholdDecoratorBuilderFactory;
    }

    protected function hasRetryThresholdDecoratorBuilderFactory(): bool
    {
        return isset($this->RetryThresholdDecoratorBuilderFactory);
    }

    protected function unsetRetryThresholdDecoratorBuilderFactory(): self
    {
        if (!$this->hasRetryThresholdDecoratorBuilderFactory()) {
            throw new LogicException('RetryThresholdDecoratorBuilderFactory is not set.');
        }
        unset($this->RetryThresholdDecoratorBuilderFactory);

        return $this;
    }
}
