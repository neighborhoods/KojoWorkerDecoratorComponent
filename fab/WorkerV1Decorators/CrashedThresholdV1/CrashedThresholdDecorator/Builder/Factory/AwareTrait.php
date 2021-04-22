<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\CrashedThresholdV1\CrashedThresholdDecorator\Builder\Factory;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\CrashedThresholdV1\CrashedThresholdDecorator\Builder\FactoryInterface;

trait AwareTrait
{
    protected $WorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilderFactory;

    public function setWorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilderFactory(FactoryInterface $CrashedThresholdDecoratorBuilderFactory): self
    {
        if ($this->hasWorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilderFactory()) {
            throw new LogicException('WorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilderFactory is already set.');
        }
        $this->WorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilderFactory = $CrashedThresholdDecoratorBuilderFactory;

        return $this;
    }

    protected function getWorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilderFactory(): FactoryInterface
    {
        if (!$this->hasWorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilderFactory()) {
            throw new LogicException('WorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilderFactory is not set.');
        }

        return $this->WorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilderFactory;
    }

    protected function hasWorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilderFactory(): bool
    {
        return isset($this->WorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilderFactory);
    }

    protected function unsetWorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilderFactory(): self
    {
        if (!$this->hasWorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilderFactory()) {
            throw new LogicException('WorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilderFactory is not set.');
        }
        unset($this->WorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilderFactory);

        return $this;
    }
}
