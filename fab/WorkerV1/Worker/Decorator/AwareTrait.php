<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1\Worker\Decorator;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1\Worker\DecoratorInterface;

trait AwareTrait
{
    protected $WorkerV1WorkerDecorator;

    public function setWorkerV1WorkerDecorator(DecoratorInterface $Decorator): self
    {
        if ($this->hasWorkerV1WorkerDecorator()) {
            throw new LogicException('WorkerV1WorkerDecorator is already set.');
        }
        $this->WorkerV1WorkerDecorator = $Decorator;

        return $this;
    }

    protected function getWorkerV1WorkerDecorator(): DecoratorInterface
    {
        if (!$this->hasWorkerV1WorkerDecorator()) {
            throw new LogicException('WorkerV1WorkerDecorator is not set.');
        }

        return $this->WorkerV1WorkerDecorator;
    }

    protected function hasWorkerV1WorkerDecorator(): bool
    {
        return isset($this->WorkerV1WorkerDecorator);
    }

    protected function unsetWorkerV1WorkerDecorator(): self
    {
        if (!$this->hasWorkerV1WorkerDecorator()) {
            throw new LogicException('WorkerV1WorkerDecorator is not set.');
        }
        unset($this->WorkerV1WorkerDecorator);

        return $this;
    }
}
