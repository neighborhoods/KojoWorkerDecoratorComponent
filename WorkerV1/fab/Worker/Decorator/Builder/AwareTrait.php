<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1\Worker\Decorator\Builder;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1\Worker\Decorator\BuilderInterface;

trait AwareTrait
{
    protected $WorkerDecoratorBuilder;

    public function setWorkerDecoratorBuilder(BuilderInterface $DecoratorBuilder): self
    {
        if ($this->hasWorkerDecoratorBuilder()) {
            throw new LogicException('WorkerDecoratorBuilder is already set.');
        }
        $this->WorkerDecoratorBuilder = $DecoratorBuilder;

        return $this;
    }

    protected function getWorkerDecoratorBuilder(): BuilderInterface
    {
        if (!$this->hasWorkerDecoratorBuilder()) {
            throw new LogicException('WorkerDecoratorBuilder is not set.');
        }

        return $this->WorkerDecoratorBuilder;
    }

    protected function hasWorkerDecoratorBuilder(): bool
    {
        return isset($this->WorkerDecoratorBuilder);
    }

    protected function unsetWorkerDecoratorBuilder(): self
    {
        if (!$this->hasWorkerDecoratorBuilder()) {
            throw new LogicException('WorkerDecoratorBuilder is not set.');
        }
        unset($this->WorkerDecoratorBuilder);

        return $this;
    }
}
