<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1\Worker\Decorator\Builder\Factory;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1\Worker\Decorator\Builder\FactoryInterface;

trait AwareTrait
{
    protected $WorkerV1WorkerDecoratorBuilderFactory;

    public function setWorkerV1WorkerDecoratorBuilderFactory(FactoryInterface $DecoratorBuilderFactory): self
    {
        if ($this->hasWorkerV1WorkerDecoratorBuilderFactory()) {
            throw new LogicException('WorkerV1WorkerDecoratorBuilderFactory is already set.');
        }
        $this->WorkerV1WorkerDecoratorBuilderFactory = $DecoratorBuilderFactory;

        return $this;
    }

    protected function getWorkerV1WorkerDecoratorBuilderFactory(): FactoryInterface
    {
        if (!$this->hasWorkerV1WorkerDecoratorBuilderFactory()) {
            throw new LogicException('WorkerV1WorkerDecoratorBuilderFactory is not set.');
        }

        return $this->WorkerV1WorkerDecoratorBuilderFactory;
    }

    protected function hasWorkerV1WorkerDecoratorBuilderFactory(): bool
    {
        return isset($this->WorkerV1WorkerDecoratorBuilderFactory);
    }

    protected function unsetWorkerV1WorkerDecoratorBuilderFactory(): self
    {
        if (!$this->hasWorkerV1WorkerDecoratorBuilderFactory()) {
            throw new LogicException('WorkerV1WorkerDecoratorBuilderFactory is not set.');
        }
        unset($this->WorkerV1WorkerDecoratorBuilderFactory);

        return $this;
    }
}
