<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\CrashedThresholdV1\CrashedThresholdDecorator\Factory;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\CrashedThresholdV1\CrashedThresholdDecorator\FactoryInterface;

trait AwareTrait
{
    protected $WorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorFactory;

    public function setWorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorFactory(FactoryInterface $CrashedThresholdDecoratorFactory): self
    {
        if ($this->hasWorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorFactory()) {
            throw new LogicException('WorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorFactory is already set.');
        }
        $this->WorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorFactory = $CrashedThresholdDecoratorFactory;

        return $this;
    }

    protected function getWorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorFactory(): FactoryInterface
    {
        if (!$this->hasWorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorFactory()) {
            throw new LogicException('WorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorFactory is not set.');
        }

        return $this->WorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorFactory;
    }

    protected function hasWorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorFactory(): bool
    {
        return isset($this->WorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorFactory);
    }

    protected function unsetWorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorFactory(): self
    {
        if (!$this->hasWorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorFactory()) {
            throw new LogicException('WorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorFactory is not set.');
        }
        unset($this->WorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorFactory);

        return $this;
    }
}
