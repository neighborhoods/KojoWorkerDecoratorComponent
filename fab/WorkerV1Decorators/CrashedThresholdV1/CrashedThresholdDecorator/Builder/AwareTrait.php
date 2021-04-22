<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\CrashedThresholdV1\CrashedThresholdDecorator\Builder;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\CrashedThresholdV1\CrashedThresholdDecorator\BuilderInterface;

trait AwareTrait
{
    protected $WorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilder;

    public function setWorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilder(BuilderInterface $CrashedThresholdDecoratorBuilder): self
    {
        if ($this->hasWorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilder()) {
            throw new LogicException('WorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilder is already set.');
        }
        $this->WorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilder = $CrashedThresholdDecoratorBuilder;

        return $this;
    }

    protected function getWorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilder(): BuilderInterface
    {
        if (!$this->hasWorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilder()) {
            throw new LogicException('WorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilder is not set.');
        }

        return $this->WorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilder;
    }

    protected function hasWorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilder(): bool
    {
        return isset($this->WorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilder);
    }

    protected function unsetWorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilder(): self
    {
        if (!$this->hasWorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilder()) {
            throw new LogicException('WorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilder is not set.');
        }
        unset($this->WorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilder);

        return $this;
    }
}
