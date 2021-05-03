<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\RetryThresholdV1\RetryThresholdDecorator;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\RetryThresholdV1\RetryThresholdDecoratorInterface;

trait AwareTrait
{
    protected $WorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecorator;

    public function setWorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecorator(RetryThresholdDecoratorInterface $RetryThresholdDecorator): self
    {
        if ($this->hasWorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecorator()) {
            throw new LogicException('WorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecorator is already set.');
        }
        $this->WorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecorator = $RetryThresholdDecorator;

        return $this;
    }

    protected function getWorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecorator(): RetryThresholdDecoratorInterface
    {
        if (!$this->hasWorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecorator()) {
            throw new LogicException('WorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecorator is not set.');
        }

        return $this->WorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecorator;
    }

    protected function hasWorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecorator(): bool
    {
        return isset($this->WorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecorator);
    }

    protected function unsetWorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecorator(): self
    {
        if (!$this->hasWorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecorator()) {
            throw new LogicException('WorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecorator is not set.');
        }
        unset($this->WorkerDecorationV1DecoratorsRetryThresholdV1RetryThresholdDecorator);

        return $this;
    }
}
