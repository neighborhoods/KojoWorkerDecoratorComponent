<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\CrashedThresholdV1\CrashedThresholdDecorator;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\CrashedThresholdV1\CrashedThresholdDecoratorInterface;

trait AwareTrait
{
    protected $WorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecorator;

    public function setWorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecorator(CrashedThresholdDecoratorInterface $CrashedThresholdDecorator): self
    {
        if ($this->hasWorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecorator()) {
            throw new LogicException('WorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecorator is already set.');
        }
        $this->WorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecorator = $CrashedThresholdDecorator;

        return $this;
    }

    protected function getWorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecorator(): CrashedThresholdDecoratorInterface
    {
        if (!$this->hasWorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecorator()) {
            throw new LogicException('WorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecorator is not set.');
        }

        return $this->WorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecorator;
    }

    protected function hasWorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecorator(): bool
    {
        return isset($this->WorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecorator);
    }

    protected function unsetWorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecorator(): self
    {
        if (!$this->hasWorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecorator()) {
            throw new LogicException('WorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecorator is not set.');
        }
        unset($this->WorkerDecorationV1DecoratorsCrashedThresholdV1CrashedThresholdDecorator);

        return $this;
    }
}
