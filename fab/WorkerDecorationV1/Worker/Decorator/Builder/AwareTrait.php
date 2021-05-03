<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1\Worker\Decorator\Builder;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1\Worker\Decorator\BuilderInterface;

trait AwareTrait
{
    protected $WorkerDecorationV1WorkerDecoratorBuilder;

    public function setWorkerDecorationV1WorkerDecoratorBuilder(BuilderInterface $DecoratorBuilder): self
    {
        if ($this->hasWorkerDecorationV1WorkerDecoratorBuilder()) {
            throw new LogicException('WorkerDecorationV1WorkerDecoratorBuilder is already set.');
        }
        $this->WorkerDecorationV1WorkerDecoratorBuilder = $DecoratorBuilder;

        return $this;
    }

    protected function getWorkerDecorationV1WorkerDecoratorBuilder(): BuilderInterface
    {
        if (!$this->hasWorkerDecorationV1WorkerDecoratorBuilder()) {
            throw new LogicException('WorkerDecorationV1WorkerDecoratorBuilder is not set.');
        }

        return $this->WorkerDecorationV1WorkerDecoratorBuilder;
    }

    protected function hasWorkerDecorationV1WorkerDecoratorBuilder(): bool
    {
        return isset($this->WorkerDecorationV1WorkerDecoratorBuilder);
    }

    protected function unsetWorkerDecorationV1WorkerDecoratorBuilder(): self
    {
        if (!$this->hasWorkerDecorationV1WorkerDecoratorBuilder()) {
            throw new LogicException('WorkerDecorationV1WorkerDecoratorBuilder is not set.');
        }
        unset($this->WorkerDecorationV1WorkerDecoratorBuilder);

        return $this;
    }
}
