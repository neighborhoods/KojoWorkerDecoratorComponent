<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\CrashedThresholdV1\CrashedThresholdDecorator\Builder\Factory;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\CrashedThresholdV1\CrashedThresholdDecorator\Builder\FactoryInterface;

trait AwareTrait
{
    protected $WorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilderFactory;

    public function setWorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilderFactory(FactoryInterface $CrashedThresholdDecoratorBuilderFactory): self
    {
        if ($this->hasWorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilderFactory()) {
            throw new LogicException('WorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilderFactory is already set.');
        }
        $this->WorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilderFactory = $CrashedThresholdDecoratorBuilderFactory;

        return $this;
    }

    protected function getWorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilderFactory(): FactoryInterface
    {
        if (!$this->hasWorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilderFactory()) {
            throw new LogicException('WorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilderFactory is not set.');
        }

        return $this->WorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilderFactory;
    }

    protected function hasWorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilderFactory(): bool
    {
        return isset($this->WorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilderFactory);
    }

    protected function unsetWorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilderFactory(): self
    {
        if (!$this->hasWorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilderFactory()) {
            throw new LogicException('WorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilderFactory is not set.');
        }
        unset($this->WorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilderFactory);

        return $this;
    }
}
