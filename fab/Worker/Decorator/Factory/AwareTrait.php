<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker\Decorator\Factory;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\Worker\Decorator\FactoryInterface;

trait AwareTrait
{
    protected $WorkerDecoratorFactory;

    public function setWorkerDecoratorFactory(FactoryInterface $DecoratorFactory): self
    {
        if ($this->hasWorkerDecoratorFactory()) {
            throw new LogicException('WorkerDecoratorFactory is already set.');
        }
        $this->WorkerDecoratorFactory = $DecoratorFactory;

        return $this;
    }

    protected function getWorkerDecoratorFactory(): FactoryInterface
    {
        if (!$this->hasWorkerDecoratorFactory()) {
            throw new LogicException('WorkerDecoratorFactory is not set.');
        }

        return $this->WorkerDecoratorFactory;
    }

    protected function hasWorkerDecoratorFactory(): bool
    {
        return isset($this->WorkerDecoratorFactory);
    }

    protected function unsetWorkerDecoratorFactory(): self
    {
        if (!$this->hasWorkerDecoratorFactory()) {
            throw new LogicException('WorkerDecoratorFactory is not set.');
        }
        unset($this->WorkerDecoratorFactory);

        return $this;
    }
}
