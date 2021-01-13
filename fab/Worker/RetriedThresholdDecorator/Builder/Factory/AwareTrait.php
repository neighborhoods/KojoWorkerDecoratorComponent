<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker\RetriedThresholdDecorator\Builder\Factory;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\Worker\RetriedThresholdDecorator\Builder\FactoryInterface;

trait AwareTrait
{
    protected $WorkerRetriedThresholdDecoratorBuilderFactory;

    public function setWorkerRetriedThresholdDecoratorBuilderFactory(FactoryInterface $RetriedThresholdDecoratorBuilderFactory): self
    {
        if ($this->hasWorkerRetriedThresholdDecoratorBuilderFactory()) {
            throw new LogicException('WorkerRetriedThresholdDecoratorBuilderFactory is already set.');
        }
        $this->WorkerRetriedThresholdDecoratorBuilderFactory = $RetriedThresholdDecoratorBuilderFactory;

        return $this;
    }

    protected function getWorkerRetriedThresholdDecoratorBuilderFactory(): FactoryInterface
    {
        if (!$this->hasWorkerRetriedThresholdDecoratorBuilderFactory()) {
            throw new LogicException('WorkerRetriedThresholdDecoratorBuilderFactory is not set.');
        }

        return $this->WorkerRetriedThresholdDecoratorBuilderFactory;
    }

    protected function hasWorkerRetriedThresholdDecoratorBuilderFactory(): bool
    {
        return isset($this->WorkerRetriedThresholdDecoratorBuilderFactory);
    }

    protected function unsetWorkerRetriedThresholdDecoratorBuilderFactory(): self
    {
        if (!$this->hasWorkerRetriedThresholdDecoratorBuilderFactory()) {
            throw new LogicException('WorkerRetriedThresholdDecoratorBuilderFactory is not set.');
        }
        unset($this->WorkerRetriedThresholdDecoratorBuilderFactory);

        return $this;
    }
}
