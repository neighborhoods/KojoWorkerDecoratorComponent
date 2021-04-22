<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\UserlandPdoV1\UserlandPdoDecorator;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\UserlandPdoV1\UserlandPdoDecoratorInterface;

trait AwareTrait
{
    protected $WorkerV1DecoratorsUserlandPdoV1UserlandPdoDecorator;

    public function setWorkerV1DecoratorsUserlandPdoV1UserlandPdoDecorator(UserlandPdoDecoratorInterface $UserlandPdoDecorator): self
    {
        if ($this->hasWorkerV1DecoratorsUserlandPdoV1UserlandPdoDecorator()) {
            throw new LogicException('WorkerV1DecoratorsUserlandPdoV1UserlandPdoDecorator is already set.');
        }
        $this->WorkerV1DecoratorsUserlandPdoV1UserlandPdoDecorator = $UserlandPdoDecorator;

        return $this;
    }

    protected function getWorkerV1DecoratorsUserlandPdoV1UserlandPdoDecorator(): UserlandPdoDecoratorInterface
    {
        if (!$this->hasWorkerV1DecoratorsUserlandPdoV1UserlandPdoDecorator()) {
            throw new LogicException('WorkerV1DecoratorsUserlandPdoV1UserlandPdoDecorator is not set.');
        }

        return $this->WorkerV1DecoratorsUserlandPdoV1UserlandPdoDecorator;
    }

    protected function hasWorkerV1DecoratorsUserlandPdoV1UserlandPdoDecorator(): bool
    {
        return isset($this->WorkerV1DecoratorsUserlandPdoV1UserlandPdoDecorator);
    }

    protected function unsetWorkerV1DecoratorsUserlandPdoV1UserlandPdoDecorator(): self
    {
        if (!$this->hasWorkerV1DecoratorsUserlandPdoV1UserlandPdoDecorator()) {
            throw new LogicException('WorkerV1DecoratorsUserlandPdoV1UserlandPdoDecorator is not set.');
        }
        unset($this->WorkerV1DecoratorsUserlandPdoV1UserlandPdoDecorator);

        return $this;
    }
}
