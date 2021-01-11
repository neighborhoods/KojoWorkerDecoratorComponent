<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker\RetriedThresholdDecorator\Builder;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\Worker\RetriedThresholdDecorator\BuilderInterface;

trait AwareTrait
{
    protected $WorkerRetriedThresholdDecoratorBuilder;

    public function setWorkerRetriedThresholdDecoratorBuilder(BuilderInterface $RetriedThresholdDecoratorBuilder): self
    {
        if ($this->hasWorkerRetriedThresholdDecoratorBuilder()) {
            throw new LogicException('WorkerRetriedThresholdDecoratorBuilder is already set.');
        }
        $this->WorkerRetriedThresholdDecoratorBuilder = $RetriedThresholdDecoratorBuilder;

        return $this;
    }

    protected function getWorkerRetriedThresholdDecoratorBuilder(): BuilderInterface
    {
        if (!$this->hasWorkerRetriedThresholdDecoratorBuilder()) {
            throw new LogicException('WorkerRetriedThresholdDecoratorBuilder is not set.');
        }

        return $this->WorkerRetriedThresholdDecoratorBuilder;
    }

    protected function hasWorkerRetriedThresholdDecoratorBuilder(): bool
    {
        return isset($this->WorkerRetriedThresholdDecoratorBuilder);
    }

    protected function unsetWorkerRetriedThresholdDecoratorBuilder(): self
    {
        if (!$this->hasWorkerRetriedThresholdDecoratorBuilder()) {
            throw new LogicException('WorkerRetriedThresholdDecoratorBuilder is not set.');
        }
        unset($this->WorkerRetriedThresholdDecoratorBuilder);

        return $this;
    }
}
