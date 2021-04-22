<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1\Worker\Decorator\Builder;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1\Worker\Decorator\BuilderInterface;

trait AwareTrait
{
    protected $WorkerV1WorkerDecoratorBuilder;

    public function setWorkerV1WorkerDecoratorBuilder(BuilderInterface $DecoratorBuilder): self
    {
        if ($this->hasWorkerV1WorkerDecoratorBuilder()) {
            throw new LogicException('WorkerV1WorkerDecoratorBuilder is already set.');
        }
        $this->WorkerV1WorkerDecoratorBuilder = $DecoratorBuilder;

        return $this;
    }

    protected function getWorkerV1WorkerDecoratorBuilder(): BuilderInterface
    {
        if (!$this->hasWorkerV1WorkerDecoratorBuilder()) {
            throw new LogicException('WorkerV1WorkerDecoratorBuilder is not set.');
        }

        return $this->WorkerV1WorkerDecoratorBuilder;
    }

    protected function hasWorkerV1WorkerDecoratorBuilder(): bool
    {
        return isset($this->WorkerV1WorkerDecoratorBuilder);
    }

    protected function unsetWorkerV1WorkerDecoratorBuilder(): self
    {
        if (!$this->hasWorkerV1WorkerDecoratorBuilder()) {
            throw new LogicException('WorkerV1WorkerDecoratorBuilder is not set.');
        }
        unset($this->WorkerV1WorkerDecoratorBuilder);

        return $this;
    }
}
