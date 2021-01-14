<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker\RetryThresholdDecorator\Builder\Factory;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\Worker\RetryThresholdDecorator\Builder\FactoryInterface;

trait AwareTrait
{
    protected $WorkerRetryThresholdDecoratorBuilderFactory;

    public function setWorkerRetryThresholdDecoratorBuilderFactory(FactoryInterface $RetryThresholdDecoratorBuilderFactory): self
    {
        if ($this->hasWorkerRetryThresholdDecoratorBuilderFactory()) {
            throw new LogicException('WorkerRetryThresholdDecoratorBuilderFactory is already set.');
        }
        $this->WorkerRetryThresholdDecoratorBuilderFactory = $RetryThresholdDecoratorBuilderFactory;

        return $this;
    }

    protected function getWorkerRetryThresholdDecoratorBuilderFactory(): FactoryInterface
    {
        if (!$this->hasWorkerRetryThresholdDecoratorBuilderFactory()) {
            throw new LogicException('WorkerRetryThresholdDecoratorBuilderFactory is not set.');
        }

        return $this->WorkerRetryThresholdDecoratorBuilderFactory;
    }

    protected function hasWorkerRetryThresholdDecoratorBuilderFactory(): bool
    {
        return isset($this->WorkerRetryThresholdDecoratorBuilderFactory);
    }

    protected function unsetWorkerRetryThresholdDecoratorBuilderFactory(): self
    {
        if (!$this->hasWorkerRetryThresholdDecoratorBuilderFactory()) {
            throw new LogicException('WorkerRetryThresholdDecoratorBuilderFactory is not set.');
        }
        unset($this->WorkerRetryThresholdDecoratorBuilderFactory);

        return $this;
    }
}
