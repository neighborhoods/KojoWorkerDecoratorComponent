<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\RetryThresholdV1\RetryThresholdDecorator\Builder;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\RetryThresholdV1\RetryThresholdDecorator\BuilderInterface;

trait AwareTrait
{
    protected $RetryThresholdDecoratorBuilder;

    public function setRetryThresholdDecoratorBuilder(BuilderInterface $RetryThresholdDecoratorBuilder): self
    {
        if ($this->hasRetryThresholdDecoratorBuilder()) {
            throw new LogicException('RetryThresholdDecoratorBuilder is already set.');
        }
        $this->RetryThresholdDecoratorBuilder = $RetryThresholdDecoratorBuilder;

        return $this;
    }

    protected function getRetryThresholdDecoratorBuilder(): BuilderInterface
    {
        if (!$this->hasRetryThresholdDecoratorBuilder()) {
            throw new LogicException('RetryThresholdDecoratorBuilder is not set.');
        }

        return $this->RetryThresholdDecoratorBuilder;
    }

    protected function hasRetryThresholdDecoratorBuilder(): bool
    {
        return isset($this->RetryThresholdDecoratorBuilder);
    }

    protected function unsetRetryThresholdDecoratorBuilder(): self
    {
        if (!$this->hasRetryThresholdDecoratorBuilder()) {
            throw new LogicException('RetryThresholdDecoratorBuilder is not set.');
        }
        unset($this->RetryThresholdDecoratorBuilder);

        return $this;
    }
}
