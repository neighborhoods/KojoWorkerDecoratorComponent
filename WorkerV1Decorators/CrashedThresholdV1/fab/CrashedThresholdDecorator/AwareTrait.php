<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\CrashedThresholdV1\CrashedThresholdDecorator;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\CrashedThresholdV1\CrashedThresholdDecoratorInterface;

trait AwareTrait
{
    protected $CrashedThresholdDecorator;

    public function setCrashedThresholdDecorator(CrashedThresholdDecoratorInterface $CrashedThresholdDecorator): self
    {
        if ($this->hasCrashedThresholdDecorator()) {
            throw new LogicException('CrashedThresholdDecorator is already set.');
        }
        $this->CrashedThresholdDecorator = $CrashedThresholdDecorator;

        return $this;
    }

    protected function getCrashedThresholdDecorator(): CrashedThresholdDecoratorInterface
    {
        if (!$this->hasCrashedThresholdDecorator()) {
            throw new LogicException('CrashedThresholdDecorator is not set.');
        }

        return $this->CrashedThresholdDecorator;
    }

    protected function hasCrashedThresholdDecorator(): bool
    {
        return isset($this->CrashedThresholdDecorator);
    }

    protected function unsetCrashedThresholdDecorator(): self
    {
        if (!$this->hasCrashedThresholdDecorator()) {
            throw new LogicException('CrashedThresholdDecorator is not set.');
        }
        unset($this->CrashedThresholdDecorator);

        return $this;
    }
}
