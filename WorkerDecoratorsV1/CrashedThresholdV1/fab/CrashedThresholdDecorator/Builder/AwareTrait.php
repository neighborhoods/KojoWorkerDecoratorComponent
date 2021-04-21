<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecoratorsV1\CrashedThresholdV1\CrashedThresholdDecorator\Builder;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecoratorsV1\CrashedThresholdV1\CrashedThresholdDecorator\BuilderInterface;

trait AwareTrait
{
    protected $CrashedThresholdDecoratorBuilder;

    public function setCrashedThresholdDecoratorBuilder(BuilderInterface $CrashedThresholdDecoratorBuilder): self
    {
        if ($this->hasCrashedThresholdDecoratorBuilder()) {
            throw new LogicException('CrashedThresholdDecoratorBuilder is already set.');
        }
        $this->CrashedThresholdDecoratorBuilder = $CrashedThresholdDecoratorBuilder;

        return $this;
    }

    protected function getCrashedThresholdDecoratorBuilder(): BuilderInterface
    {
        if (!$this->hasCrashedThresholdDecoratorBuilder()) {
            throw new LogicException('CrashedThresholdDecoratorBuilder is not set.');
        }

        return $this->CrashedThresholdDecoratorBuilder;
    }

    protected function hasCrashedThresholdDecoratorBuilder(): bool
    {
        return isset($this->CrashedThresholdDecoratorBuilder);
    }

    protected function unsetCrashedThresholdDecoratorBuilder(): self
    {
        if (!$this->hasCrashedThresholdDecoratorBuilder()) {
            throw new LogicException('CrashedThresholdDecoratorBuilder is not set.');
        }
        unset($this->CrashedThresholdDecoratorBuilder);

        return $this;
    }
}
