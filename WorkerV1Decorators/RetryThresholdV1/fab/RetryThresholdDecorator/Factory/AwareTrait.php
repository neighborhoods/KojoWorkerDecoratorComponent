<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\RetryThresholdV1\RetryThresholdDecorator\Factory;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\RetryThresholdV1\RetryThresholdDecorator\FactoryInterface;

trait AwareTrait
{
    protected $RetryThresholdDecoratorFactory;

    public function setRetryThresholdDecoratorFactory(FactoryInterface $RetryThresholdDecoratorFactory): self
    {
        if ($this->hasRetryThresholdDecoratorFactory()) {
            throw new LogicException('RetryThresholdDecoratorFactory is already set.');
        }
        $this->RetryThresholdDecoratorFactory = $RetryThresholdDecoratorFactory;

        return $this;
    }

    protected function getRetryThresholdDecoratorFactory(): FactoryInterface
    {
        if (!$this->hasRetryThresholdDecoratorFactory()) {
            throw new LogicException('RetryThresholdDecoratorFactory is not set.');
        }

        return $this->RetryThresholdDecoratorFactory;
    }

    protected function hasRetryThresholdDecoratorFactory(): bool
    {
        return isset($this->RetryThresholdDecoratorFactory);
    }

    protected function unsetRetryThresholdDecoratorFactory(): self
    {
        if (!$this->hasRetryThresholdDecoratorFactory()) {
            throw new LogicException('RetryThresholdDecoratorFactory is not set.');
        }
        unset($this->RetryThresholdDecoratorFactory);

        return $this;
    }
}
