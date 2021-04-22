<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\RetryThresholdV1\RetryThresholdDecorator;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\RetryThresholdV1\RetryThresholdDecoratorInterface;

trait AwareTrait
{
    protected $WorkerV1DecoratorsRetryThresholdV1RetryThresholdDecorator;

    public function setWorkerV1DecoratorsRetryThresholdV1RetryThresholdDecorator(RetryThresholdDecoratorInterface $RetryThresholdDecorator): self
    {
        if ($this->hasWorkerV1DecoratorsRetryThresholdV1RetryThresholdDecorator()) {
            throw new LogicException('WorkerV1DecoratorsRetryThresholdV1RetryThresholdDecorator is already set.');
        }
        $this->WorkerV1DecoratorsRetryThresholdV1RetryThresholdDecorator = $RetryThresholdDecorator;

        return $this;
    }

    protected function getWorkerV1DecoratorsRetryThresholdV1RetryThresholdDecorator(): RetryThresholdDecoratorInterface
    {
        if (!$this->hasWorkerV1DecoratorsRetryThresholdV1RetryThresholdDecorator()) {
            throw new LogicException('WorkerV1DecoratorsRetryThresholdV1RetryThresholdDecorator is not set.');
        }

        return $this->WorkerV1DecoratorsRetryThresholdV1RetryThresholdDecorator;
    }

    protected function hasWorkerV1DecoratorsRetryThresholdV1RetryThresholdDecorator(): bool
    {
        return isset($this->WorkerV1DecoratorsRetryThresholdV1RetryThresholdDecorator);
    }

    protected function unsetWorkerV1DecoratorsRetryThresholdV1RetryThresholdDecorator(): self
    {
        if (!$this->hasWorkerV1DecoratorsRetryThresholdV1RetryThresholdDecorator()) {
            throw new LogicException('WorkerV1DecoratorsRetryThresholdV1RetryThresholdDecorator is not set.');
        }
        unset($this->WorkerV1DecoratorsRetryThresholdV1RetryThresholdDecorator);

        return $this;
    }
}
