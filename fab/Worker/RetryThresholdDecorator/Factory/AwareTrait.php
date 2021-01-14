<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker\RetryThresholdDecorator\Factory;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\Worker\RetryThresholdDecorator\FactoryInterface;

trait AwareTrait
{
    protected $WorkerRetryThresholdDecoratorFactory;

    public function setWorkerRetryThresholdDecoratorFactory(FactoryInterface $RetryThresholdDecoratorFactory): self
    {
        if ($this->hasWorkerRetryThresholdDecoratorFactory()) {
            throw new LogicException('WorkerRetryThresholdDecoratorFactory is already set.');
        }
        $this->WorkerRetryThresholdDecoratorFactory = $RetryThresholdDecoratorFactory;

        return $this;
    }

    protected function getWorkerRetryThresholdDecoratorFactory(): FactoryInterface
    {
        if (!$this->hasWorkerRetryThresholdDecoratorFactory()) {
            throw new LogicException('WorkerRetryThresholdDecoratorFactory is not set.');
        }

        return $this->WorkerRetryThresholdDecoratorFactory;
    }

    protected function hasWorkerRetryThresholdDecoratorFactory(): bool
    {
        return isset($this->WorkerRetryThresholdDecoratorFactory);
    }

    protected function unsetWorkerRetryThresholdDecoratorFactory(): self
    {
        if (!$this->hasWorkerRetryThresholdDecoratorFactory()) {
            throw new LogicException('WorkerRetryThresholdDecoratorFactory is not set.');
        }
        unset($this->WorkerRetryThresholdDecoratorFactory);

        return $this;
    }
}
