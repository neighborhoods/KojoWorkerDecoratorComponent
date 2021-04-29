<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\CrashedThresholdV1\CrashedThresholdDecorator\Builder;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\CrashedThresholdV1\CrashedThresholdDecorator\BuilderInterface;

trait AwareTrait
{
    protected $WorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilder;

    public function setWorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilder(BuilderInterface $CrashedThresholdDecoratorBuilder): self
    {
        if ($this->hasWorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilder()) {
            throw new LogicException('WorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilder is already set.');
        }
        $this->WorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilder = $CrashedThresholdDecoratorBuilder;

        return $this;
    }

    protected function getWorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilder(): BuilderInterface
    {
        if (!$this->hasWorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilder()) {
            throw new LogicException('WorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilder is not set.');
        }

        return $this->WorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilder;
    }

    protected function hasWorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilder(): bool
    {
        return isset($this->WorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilder);
    }

    protected function unsetWorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilder(): self
    {
        if (!$this->hasWorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilder()) {
            throw new LogicException('WorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilder is not set.');
        }
        unset($this->WorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecoratorBuilder);

        return $this;
    }
}
