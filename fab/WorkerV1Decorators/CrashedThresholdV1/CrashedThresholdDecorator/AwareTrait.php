<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\CrashedThresholdV1\CrashedThresholdDecorator;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\CrashedThresholdV1\CrashedThresholdDecoratorInterface;

trait AwareTrait
{
    protected $WorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecorator;

    public function setWorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecorator(CrashedThresholdDecoratorInterface $CrashedThresholdDecorator): self
    {
        if ($this->hasWorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecorator()) {
            throw new LogicException('WorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecorator is already set.');
        }
        $this->WorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecorator = $CrashedThresholdDecorator;

        return $this;
    }

    protected function getWorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecorator(): CrashedThresholdDecoratorInterface
    {
        if (!$this->hasWorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecorator()) {
            throw new LogicException('WorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecorator is not set.');
        }

        return $this->WorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecorator;
    }

    protected function hasWorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecorator(): bool
    {
        return isset($this->WorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecorator);
    }

    protected function unsetWorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecorator(): self
    {
        if (!$this->hasWorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecorator()) {
            throw new LogicException('WorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecorator is not set.');
        }
        unset($this->WorkerV1DecoratorsCrashedThresholdV1CrashedThresholdDecorator);

        return $this;
    }
}
