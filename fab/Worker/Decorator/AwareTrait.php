<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker\Decorator;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\Worker\DecoratorInterface;

trait AwareTrait
{
    protected $WorkerDecorator;

    public function setWorkerDecorator(DecoratorInterface $Decorator): self
    {
        if ($this->hasWorkerDecorator()) {
            throw new LogicException('WorkerDecorator is already set.');
        }
        $this->WorkerDecorator = $Decorator;

        return $this;
    }

    protected function getWorkerDecorator(): DecoratorInterface
    {
        if (!$this->hasWorkerDecorator()) {
            throw new LogicException('WorkerDecorator is not set.');
        }

        return $this->WorkerDecorator;
    }

    protected function hasWorkerDecorator(): bool
    {
        return isset($this->WorkerDecorator);
    }

    protected function unsetWorkerDecorator(): self
    {
        if (!$this->hasWorkerDecorator()) {
            throw new LogicException('WorkerDecorator is not set.');
        }
        unset($this->WorkerDecorator);

        return $this;
    }
}
