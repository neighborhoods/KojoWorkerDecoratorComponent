<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\CrashedThresholdV1\CrashedThresholdDecorator\Factory;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\CrashedThresholdV1\CrashedThresholdDecorator\FactoryInterface;

trait AwareTrait
{
    protected $CrashedThresholdDecoratorFactory;

    public function setCrashedThresholdDecoratorFactory(FactoryInterface $CrashedThresholdDecoratorFactory): self
    {
        if ($this->hasCrashedThresholdDecoratorFactory()) {
            throw new LogicException('CrashedThresholdDecoratorFactory is already set.');
        }
        $this->CrashedThresholdDecoratorFactory = $CrashedThresholdDecoratorFactory;

        return $this;
    }

    protected function getCrashedThresholdDecoratorFactory(): FactoryInterface
    {
        if (!$this->hasCrashedThresholdDecoratorFactory()) {
            throw new LogicException('CrashedThresholdDecoratorFactory is not set.');
        }

        return $this->CrashedThresholdDecoratorFactory;
    }

    protected function hasCrashedThresholdDecoratorFactory(): bool
    {
        return isset($this->CrashedThresholdDecoratorFactory);
    }

    protected function unsetCrashedThresholdDecoratorFactory(): self
    {
        if (!$this->hasCrashedThresholdDecoratorFactory()) {
            throw new LogicException('CrashedThresholdDecoratorFactory is not set.');
        }
        unset($this->CrashedThresholdDecoratorFactory);

        return $this;
    }
}
