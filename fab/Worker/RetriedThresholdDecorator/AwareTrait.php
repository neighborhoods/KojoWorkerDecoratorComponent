<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker\RetriedThresholdDecorator;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\Worker\RetriedThresholdDecoratorInterface;

trait AwareTrait
{
    protected $WorkerRetriedThresholdDecorator;

    public function setWorkerRetriedThresholdDecorator(RetriedThresholdDecoratorInterface $RetriedThresholdDecorator): self
    {
        if ($this->hasWorkerRetriedThresholdDecorator()) {
            throw new LogicException('WorkerRetriedThresholdDecorator is already set.');
        }
        $this->WorkerRetriedThresholdDecorator = $RetriedThresholdDecorator;

        return $this;
    }

    protected function getWorkerRetriedThresholdDecorator(): RetriedThresholdDecoratorInterface
    {
        if (!$this->hasWorkerRetriedThresholdDecorator()) {
            throw new LogicException('WorkerRetriedThresholdDecorator is not set.');
        }

        return $this->WorkerRetriedThresholdDecorator;
    }

    protected function hasWorkerRetriedThresholdDecorator(): bool
    {
        return isset($this->WorkerRetriedThresholdDecorator);
    }

    protected function unsetWorkerRetriedThresholdDecorator(): self
    {
        if (!$this->hasWorkerRetriedThresholdDecorator()) {
            throw new LogicException('WorkerRetriedThresholdDecorator is not set.');
        }
        unset($this->WorkerRetriedThresholdDecorator);

        return $this;
    }
}
