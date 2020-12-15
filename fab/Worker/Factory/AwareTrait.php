<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker\Factory;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\Worker\FactoryInterface;

trait AwareTrait
{
    protected $WorkerFactory;

    public function setWorkerFactory(FactoryInterface $WorkerFactory): self
    {
        if ($this->hasWorkerFactory()) {
            throw new LogicException('WorkerFactory is already set.');
        }
        $this->WorkerFactory = $WorkerFactory;

        return $this;
    }

    protected function getWorkerFactory(): FactoryInterface
    {
        if (!$this->hasWorkerFactory()) {
            throw new LogicException('WorkerFactory is not set.');
        }

        return $this->WorkerFactory;
    }

    protected function hasWorkerFactory(): bool
    {
        return isset($this->WorkerFactory);
    }

    protected function unsetWorkerFactory(): self
    {
        if (!$this->hasWorkerFactory()) {
            throw new LogicException('WorkerFactory is not set.');
        }
        unset($this->WorkerFactory);

        return $this;
    }
}
