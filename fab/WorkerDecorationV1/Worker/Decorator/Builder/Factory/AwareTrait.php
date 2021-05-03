<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1\Worker\Decorator\Builder\Factory;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1\Worker\Decorator\Builder\FactoryInterface;

trait AwareTrait
{
    protected $WorkerDecorationV1WorkerDecoratorBuilderFactory;

    public function setWorkerDecorationV1WorkerDecoratorBuilderFactory(FactoryInterface $DecoratorBuilderFactory): self
    {
        if ($this->hasWorkerDecorationV1WorkerDecoratorBuilderFactory()) {
            throw new LogicException('WorkerDecorationV1WorkerDecoratorBuilderFactory is already set.');
        }
        $this->WorkerDecorationV1WorkerDecoratorBuilderFactory = $DecoratorBuilderFactory;

        return $this;
    }

    protected function getWorkerDecorationV1WorkerDecoratorBuilderFactory(): FactoryInterface
    {
        if (!$this->hasWorkerDecorationV1WorkerDecoratorBuilderFactory()) {
            throw new LogicException('WorkerDecorationV1WorkerDecoratorBuilderFactory is not set.');
        }

        return $this->WorkerDecorationV1WorkerDecoratorBuilderFactory;
    }

    protected function hasWorkerDecorationV1WorkerDecoratorBuilderFactory(): bool
    {
        return isset($this->WorkerDecorationV1WorkerDecoratorBuilderFactory);
    }

    protected function unsetWorkerDecorationV1WorkerDecoratorBuilderFactory(): self
    {
        if (!$this->hasWorkerDecorationV1WorkerDecoratorBuilderFactory()) {
            throw new LogicException('WorkerDecorationV1WorkerDecoratorBuilderFactory is not set.');
        }
        unset($this->WorkerDecorationV1WorkerDecoratorBuilderFactory);

        return $this;
    }
}
