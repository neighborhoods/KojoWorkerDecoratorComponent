<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker\CrashedThresholdDecorator\Factory;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\Worker\CrashedThresholdDecorator\FactoryInterface;

trait AwareTrait
{
    protected $WorkerCrashedThresholdDecoratorFactory;

    public function setWorkerCrashedThresholdDecoratorFactory(FactoryInterface $CrashedThresholdDecoratorFactory): self
    {
        if ($this->hasWorkerCrashedThresholdDecoratorFactory()) {
            throw new LogicException('WorkerCrashedThresholdDecoratorFactory is already set.');
        }
        $this->WorkerCrashedThresholdDecoratorFactory = $CrashedThresholdDecoratorFactory;

        return $this;
    }

    protected function getWorkerCrashedThresholdDecoratorFactory(): FactoryInterface
    {
        if (!$this->hasWorkerCrashedThresholdDecoratorFactory()) {
            throw new LogicException('WorkerCrashedThresholdDecoratorFactory is not set.');
        }

        return $this->WorkerCrashedThresholdDecoratorFactory;
    }

    protected function hasWorkerCrashedThresholdDecoratorFactory(): bool
    {
        return isset($this->WorkerCrashedThresholdDecoratorFactory);
    }

    protected function unsetWorkerCrashedThresholdDecoratorFactory(): self
    {
        if (!$this->hasWorkerCrashedThresholdDecoratorFactory()) {
            throw new LogicException('WorkerCrashedThresholdDecoratorFactory is not set.');
        }
        unset($this->WorkerCrashedThresholdDecoratorFactory);

        return $this;
    }
}
