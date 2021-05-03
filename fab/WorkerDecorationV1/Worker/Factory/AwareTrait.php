<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1\Worker\Factory;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1\Worker\FactoryInterface;

trait AwareTrait
{
    protected $WorkerDecorationV1WorkerFactory;

    public function setWorkerDecorationV1WorkerFactory(FactoryInterface $WorkerFactory): self
    {
        if ($this->hasWorkerDecorationV1WorkerFactory()) {
            throw new LogicException('WorkerDecorationV1WorkerFactory is already set.');
        }
        $this->WorkerDecorationV1WorkerFactory = $WorkerFactory;

        return $this;
    }

    protected function getWorkerDecorationV1WorkerFactory(): FactoryInterface
    {
        if (!$this->hasWorkerDecorationV1WorkerFactory()) {
            throw new LogicException('WorkerDecorationV1WorkerFactory is not set.');
        }

        return $this->WorkerDecorationV1WorkerFactory;
    }

    protected function hasWorkerDecorationV1WorkerFactory(): bool
    {
        return isset($this->WorkerDecorationV1WorkerFactory);
    }

    protected function unsetWorkerDecorationV1WorkerFactory(): self
    {
        if (!$this->hasWorkerDecorationV1WorkerFactory()) {
            throw new LogicException('WorkerDecorationV1WorkerFactory is not set.');
        }
        unset($this->WorkerDecorationV1WorkerFactory);

        return $this;
    }
}
