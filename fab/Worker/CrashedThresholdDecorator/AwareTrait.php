<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker\CrashedThresholdDecorator;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\Worker\CrashedThresholdDecoratorInterface;

trait AwareTrait
{
    protected $WorkerCrashedThresholdDecorator;

    public function setWorkerCrashedThresholdDecorator(CrashedThresholdDecoratorInterface $CrashedThresholdDecorator): self
    {
        if ($this->hasWorkerCrashedThresholdDecorator()) {
            throw new LogicException('WorkerCrashedThresholdDecorator is already set.');
        }
        $this->WorkerCrashedThresholdDecorator = $CrashedThresholdDecorator;

        return $this;
    }

    protected function getWorkerCrashedThresholdDecorator(): CrashedThresholdDecoratorInterface
    {
        if (!$this->hasWorkerCrashedThresholdDecorator()) {
            throw new LogicException('WorkerCrashedThresholdDecorator is not set.');
        }

        return $this->WorkerCrashedThresholdDecorator;
    }

    protected function hasWorkerCrashedThresholdDecorator(): bool
    {
        return isset($this->WorkerCrashedThresholdDecorator);
    }

    protected function unsetWorkerCrashedThresholdDecorator(): self
    {
        if (!$this->hasWorkerCrashedThresholdDecorator()) {
            throw new LogicException('WorkerCrashedThresholdDecorator is not set.');
        }
        unset($this->WorkerCrashedThresholdDecorator);

        return $this;
    }
}
