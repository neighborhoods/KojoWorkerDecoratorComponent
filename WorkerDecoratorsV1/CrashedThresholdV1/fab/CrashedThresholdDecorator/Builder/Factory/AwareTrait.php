<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecoratorsV1\CrashedThresholdV1\CrashedThresholdDecorator\Builder\Factory;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecoratorsV1\CrashedThresholdV1\CrashedThresholdDecorator\Builder\FactoryInterface;

trait AwareTrait
{
    protected $CrashedThresholdDecoratorBuilderFactory;

    public function setCrashedThresholdDecoratorBuilderFactory(FactoryInterface $CrashedThresholdDecoratorBuilderFactory): self
    {
        if ($this->hasCrashedThresholdDecoratorBuilderFactory()) {
            throw new LogicException('CrashedThresholdDecoratorBuilderFactory is already set.');
        }
        $this->CrashedThresholdDecoratorBuilderFactory = $CrashedThresholdDecoratorBuilderFactory;

        return $this;
    }

    protected function getCrashedThresholdDecoratorBuilderFactory(): FactoryInterface
    {
        if (!$this->hasCrashedThresholdDecoratorBuilderFactory()) {
            throw new LogicException('CrashedThresholdDecoratorBuilderFactory is not set.');
        }

        return $this->CrashedThresholdDecoratorBuilderFactory;
    }

    protected function hasCrashedThresholdDecoratorBuilderFactory(): bool
    {
        return isset($this->CrashedThresholdDecoratorBuilderFactory);
    }

    protected function unsetCrashedThresholdDecoratorBuilderFactory(): self
    {
        if (!$this->hasCrashedThresholdDecoratorBuilderFactory()) {
            throw new LogicException('CrashedThresholdDecoratorBuilderFactory is not set.');
        }
        unset($this->CrashedThresholdDecoratorBuilderFactory);

        return $this;
    }
}
