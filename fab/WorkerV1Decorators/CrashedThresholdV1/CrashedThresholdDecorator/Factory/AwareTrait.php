<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\CrashedThresholdV1\CrashedThresholdDecorator\Factory;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\CrashedThresholdV1\CrashedThresholdDecorator\FactoryInterface;

trait AwareTrait
{
    protected $WorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorFactory;

    public function setWorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorFactory(FactoryInterface $CrashedThresholdDecoratorFactory): self
    {
        if ($this->hasWorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorFactory()) {
            throw new LogicException('WorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorFactory is already set.');
        }
        $this->WorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorFactory = $CrashedThresholdDecoratorFactory;

        return $this;
    }

    protected function getWorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorFactory(): FactoryInterface
    {
        if (!$this->hasWorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorFactory()) {
            throw new LogicException('WorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorFactory is not set.');
        }

        return $this->WorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorFactory;
    }

    protected function hasWorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorFactory(): bool
    {
        return isset($this->WorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorFactory);
    }

    protected function unsetWorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorFactory(): self
    {
        if (!$this->hasWorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorFactory()) {
            throw new LogicException('WorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorFactory is not set.');
        }
        unset($this->WorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorFactory);

        return $this;
    }
}
