<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\RetryThresholdV1\RetryThresholdDecorator\Builder;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\RetryThresholdV1\RetryThresholdDecorator\BuilderInterface;

trait AwareTrait
{
    protected $WorkerV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilder;

    public function setWorkerV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilder(BuilderInterface $RetryThresholdDecoratorBuilder): self
    {
        if ($this->hasWorkerV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilder()) {
            throw new LogicException('WorkerV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilder is already set.');
        }
        $this->WorkerV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilder = $RetryThresholdDecoratorBuilder;

        return $this;
    }

    protected function getWorkerV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilder(): BuilderInterface
    {
        if (!$this->hasWorkerV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilder()) {
            throw new LogicException('WorkerV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilder is not set.');
        }

        return $this->WorkerV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilder;
    }

    protected function hasWorkerV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilder(): bool
    {
        return isset($this->WorkerV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilder);
    }

    protected function unsetWorkerV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilder(): self
    {
        if (!$this->hasWorkerV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilder()) {
            throw new LogicException('WorkerV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilder is not set.');
        }
        unset($this->WorkerV1DecoratorsRetryThresholdV1RetryThresholdDecoratorBuilder);

        return $this;
    }
}
