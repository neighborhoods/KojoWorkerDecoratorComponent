<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1\Worker\Decorator;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1\Worker\DecoratorInterface;

trait AwareTrait
{
    protected $WorkerDecorationV1WorkerDecorator;

    public function setWorkerDecorationV1WorkerDecorator(DecoratorInterface $Decorator): self
    {
        if ($this->hasWorkerDecorationV1WorkerDecorator()) {
            throw new LogicException('WorkerDecorationV1WorkerDecorator is already set.');
        }
        $this->WorkerDecorationV1WorkerDecorator = $Decorator;

        return $this;
    }

    protected function getWorkerDecorationV1WorkerDecorator(): DecoratorInterface
    {
        if (!$this->hasWorkerDecorationV1WorkerDecorator()) {
            throw new LogicException('WorkerDecorationV1WorkerDecorator is not set.');
        }

        return $this->WorkerDecorationV1WorkerDecorator;
    }

    protected function hasWorkerDecorationV1WorkerDecorator(): bool
    {
        return isset($this->WorkerDecorationV1WorkerDecorator);
    }

    protected function unsetWorkerDecorationV1WorkerDecorator(): self
    {
        if (!$this->hasWorkerDecorationV1WorkerDecorator()) {
            throw new LogicException('WorkerDecorationV1WorkerDecorator is not set.');
        }
        unset($this->WorkerDecorationV1WorkerDecorator);

        return $this;
    }
}
