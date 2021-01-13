<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker\RetriedThresholdDecorator\Factory;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\Worker\RetriedThresholdDecorator\FactoryInterface;

trait AwareTrait
{
    protected $WorkerRetriedThresholdDecoratorFactory;

    public function setWorkerRetriedThresholdDecoratorFactory(FactoryInterface $RetriedThresholdDecoratorFactory): self
    {
        if ($this->hasWorkerRetriedThresholdDecoratorFactory()) {
            throw new LogicException('WorkerRetriedThresholdDecoratorFactory is already set.');
        }
        $this->WorkerRetriedThresholdDecoratorFactory = $RetriedThresholdDecoratorFactory;

        return $this;
    }

    protected function getWorkerRetriedThresholdDecoratorFactory(): FactoryInterface
    {
        if (!$this->hasWorkerRetriedThresholdDecoratorFactory()) {
            throw new LogicException('WorkerRetriedThresholdDecoratorFactory is not set.');
        }

        return $this->WorkerRetriedThresholdDecoratorFactory;
    }

    protected function hasWorkerRetriedThresholdDecoratorFactory(): bool
    {
        return isset($this->WorkerRetriedThresholdDecoratorFactory);
    }

    protected function unsetWorkerRetriedThresholdDecoratorFactory(): self
    {
        if (!$this->hasWorkerRetriedThresholdDecoratorFactory()) {
            throw new LogicException('WorkerRetriedThresholdDecoratorFactory is not set.');
        }
        unset($this->WorkerRetriedThresholdDecoratorFactory);

        return $this;
    }
}
