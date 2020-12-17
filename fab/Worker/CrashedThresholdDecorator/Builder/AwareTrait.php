<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker\CrashedThresholdDecorator\Builder;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\Worker\CrashedThresholdDecorator\BuilderInterface;

trait AwareTrait
{
    protected $WorkerCrashedThresholdDecoratorBuilder;

    public function setWorkerCrashedThresholdDecoratorBuilder(BuilderInterface $CrashedThresholdDecoratorBuilder): self
    {
        if ($this->hasWorkerCrashedThresholdDecoratorBuilder()) {
            throw new LogicException('WorkerCrashedThresholdDecoratorBuilder is already set.');
        }
        $this->WorkerCrashedThresholdDecoratorBuilder = $CrashedThresholdDecoratorBuilder;

        return $this;
    }

    protected function getWorkerCrashedThresholdDecoratorBuilder(): BuilderInterface
    {
        if (!$this->hasWorkerCrashedThresholdDecoratorBuilder()) {
            throw new LogicException('WorkerCrashedThresholdDecoratorBuilder is not set.');
        }

        return $this->WorkerCrashedThresholdDecoratorBuilder;
    }

    protected function hasWorkerCrashedThresholdDecoratorBuilder(): bool
    {
        return isset($this->WorkerCrashedThresholdDecoratorBuilder);
    }

    protected function unsetWorkerCrashedThresholdDecoratorBuilder(): self
    {
        if (!$this->hasWorkerCrashedThresholdDecoratorBuilder()) {
            throw new LogicException('WorkerCrashedThresholdDecoratorBuilder is not set.');
        }
        unset($this->WorkerCrashedThresholdDecoratorBuilder);

        return $this;
    }
}
