<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker\RetryThresholdDecorator;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\Worker\RetryThresholdDecoratorInterface;

trait AwareTrait
{
    protected $WorkerRetryThresholdDecorator;

    public function setWorkerRetryThresholdDecorator(RetryThresholdDecoratorInterface $RetryThresholdDecorator): self
    {
        if ($this->hasWorkerRetryThresholdDecorator()) {
            throw new LogicException('WorkerRetryThresholdDecorator is already set.');
        }
        $this->WorkerRetryThresholdDecorator = $RetryThresholdDecorator;

        return $this;
    }

    protected function getWorkerRetryThresholdDecorator(): RetryThresholdDecoratorInterface
    {
        if (!$this->hasWorkerRetryThresholdDecorator()) {
            throw new LogicException('WorkerRetryThresholdDecorator is not set.');
        }

        return $this->WorkerRetryThresholdDecorator;
    }

    protected function hasWorkerRetryThresholdDecorator(): bool
    {
        return isset($this->WorkerRetryThresholdDecorator);
    }

    protected function unsetWorkerRetryThresholdDecorator(): self
    {
        if (!$this->hasWorkerRetryThresholdDecorator()) {
            throw new LogicException('WorkerRetryThresholdDecorator is not set.');
        }
        unset($this->WorkerRetryThresholdDecorator);

        return $this;
    }
}
