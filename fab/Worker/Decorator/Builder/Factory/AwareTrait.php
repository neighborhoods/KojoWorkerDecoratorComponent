<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker\Decorator\Builder\Factory;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\Worker\Decorator\Builder\FactoryInterface;

trait AwareTrait
{
    protected $WorkerDecoratorBuilderFactory;

    public function setWorkerDecoratorBuilderFactory(FactoryInterface $DecoratorBuilderFactory): self
    {
        if ($this->hasWorkerDecoratorBuilderFactory()) {
            throw new LogicException('WorkerDecoratorBuilderFactory is already set.');
        }
        $this->WorkerDecoratorBuilderFactory = $DecoratorBuilderFactory;

        return $this;
    }

    protected function getWorkerDecoratorBuilderFactory(): FactoryInterface
    {
        if (!$this->hasWorkerDecoratorBuilderFactory()) {
            throw new LogicException('WorkerDecoratorBuilderFactory is not set.');
        }

        return $this->WorkerDecoratorBuilderFactory;
    }

    protected function hasWorkerDecoratorBuilderFactory(): bool
    {
        return isset($this->WorkerDecoratorBuilderFactory);
    }

    protected function unsetWorkerDecoratorBuilderFactory(): self
    {
        if (!$this->hasWorkerDecoratorBuilderFactory()) {
            throw new LogicException('WorkerDecoratorBuilderFactory is not set.');
        }
        unset($this->WorkerDecoratorBuilderFactory);

        return $this;
    }
}
