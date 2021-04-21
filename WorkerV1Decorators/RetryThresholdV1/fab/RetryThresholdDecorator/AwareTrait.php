<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\RetryThresholdV1\RetryThresholdDecorator;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\RetryThresholdV1\RetryThresholdDecoratorInterface;

trait AwareTrait
{
    protected $RetryThresholdDecorator;

    public function setRetryThresholdDecorator(RetryThresholdDecoratorInterface $RetryThresholdDecorator): self
    {
        if ($this->hasRetryThresholdDecorator()) {
            throw new LogicException('RetryThresholdDecorator is already set.');
        }
        $this->RetryThresholdDecorator = $RetryThresholdDecorator;

        return $this;
    }

    protected function getRetryThresholdDecorator(): RetryThresholdDecoratorInterface
    {
        if (!$this->hasRetryThresholdDecorator()) {
            throw new LogicException('RetryThresholdDecorator is not set.');
        }

        return $this->RetryThresholdDecorator;
    }

    protected function hasRetryThresholdDecorator(): bool
    {
        return isset($this->RetryThresholdDecorator);
    }

    protected function unsetRetryThresholdDecorator(): self
    {
        if (!$this->hasRetryThresholdDecorator()) {
            throw new LogicException('RetryThresholdDecorator is not set.');
        }
        unset($this->RetryThresholdDecorator);

        return $this;
    }
}
