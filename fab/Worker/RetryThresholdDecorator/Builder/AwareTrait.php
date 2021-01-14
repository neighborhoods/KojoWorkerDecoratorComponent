<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker\RetryThresholdDecorator\Builder;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\Worker\RetryThresholdDecorator\BuilderInterface;

trait AwareTrait
{
    protected $WorkerRetryThresholdDecoratorBuilder;

    public function setWorkerRetryThresholdDecoratorBuilder(BuilderInterface $RetryThresholdDecoratorBuilder): self
    {
        if ($this->hasWorkerRetryThresholdDecoratorBuilder()) {
            throw new LogicException('WorkerRetryThresholdDecoratorBuilder is already set.');
        }
        $this->WorkerRetryThresholdDecoratorBuilder = $RetryThresholdDecoratorBuilder;

        return $this;
    }

    protected function getWorkerRetryThresholdDecoratorBuilder(): BuilderInterface
    {
        if (!$this->hasWorkerRetryThresholdDecoratorBuilder()) {
            throw new LogicException('WorkerRetryThresholdDecoratorBuilder is not set.');
        }

        return $this->WorkerRetryThresholdDecoratorBuilder;
    }

    protected function hasWorkerRetryThresholdDecoratorBuilder(): bool
    {
        return isset($this->WorkerRetryThresholdDecoratorBuilder);
    }

    protected function unsetWorkerRetryThresholdDecoratorBuilder(): self
    {
        if (!$this->hasWorkerRetryThresholdDecoratorBuilder()) {
            throw new LogicException('WorkerRetryThresholdDecoratorBuilder is not set.');
        }
        unset($this->WorkerRetryThresholdDecoratorBuilder);

        return $this;
    }
}
