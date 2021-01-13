<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker\CrashedThresholdDecorator\Builder\Factory;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\Worker\CrashedThresholdDecorator\Builder\FactoryInterface;

trait AwareTrait
{
    protected $WorkerCrashedThresholdDecoratorBuilderFactory;

    public function setWorkerCrashedThresholdDecoratorBuilderFactory(FactoryInterface $CrashedThresholdDecoratorBuilderFactory): self
    {
        if ($this->hasWorkerCrashedThresholdDecoratorBuilderFactory()) {
            throw new LogicException('WorkerCrashedThresholdDecoratorBuilderFactory is already set.');
        }
        $this->WorkerCrashedThresholdDecoratorBuilderFactory = $CrashedThresholdDecoratorBuilderFactory;

        return $this;
    }

    protected function getWorkerCrashedThresholdDecoratorBuilderFactory(): FactoryInterface
    {
        if (!$this->hasWorkerCrashedThresholdDecoratorBuilderFactory()) {
            throw new LogicException('WorkerCrashedThresholdDecoratorBuilderFactory is not set.');
        }

        return $this->WorkerCrashedThresholdDecoratorBuilderFactory;
    }

    protected function hasWorkerCrashedThresholdDecoratorBuilderFactory(): bool
    {
        return isset($this->WorkerCrashedThresholdDecoratorBuilderFactory);
    }

    protected function unsetWorkerCrashedThresholdDecoratorBuilderFactory(): self
    {
        if (!$this->hasWorkerCrashedThresholdDecoratorBuilderFactory()) {
            throw new LogicException('WorkerCrashedThresholdDecoratorBuilderFactory is not set.');
        }
        unset($this->WorkerCrashedThresholdDecoratorBuilderFactory);

        return $this;
    }
}
