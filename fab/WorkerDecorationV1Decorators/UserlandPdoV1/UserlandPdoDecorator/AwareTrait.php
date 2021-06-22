<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\UserlandPdoV1\UserlandPdoDecorator;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\UserlandPdoV1\UserlandPdoDecoratorInterface;

trait AwareTrait
{
    protected $WorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecorator;

    public function setWorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecorator(UserlandPdoDecoratorInterface $UserlandPdoDecorator): self
    {
        if ($this->hasWorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecorator()) {
            throw new LogicException('WorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecorator is already set.');
        }
        $this->WorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecorator = $UserlandPdoDecorator;

        return $this;
    }

    protected function getWorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecorator(): UserlandPdoDecoratorInterface
    {
        if (!$this->hasWorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecorator()) {
            throw new LogicException('WorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecorator is not set.');
        }

        return $this->WorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecorator;
    }

    protected function hasWorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecorator(): bool
    {
        return isset($this->WorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecorator);
    }

    protected function unsetWorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecorator(): self
    {
        if (!$this->hasWorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecorator()) {
            throw new LogicException('WorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecorator is not set.');
        }
        unset($this->WorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecorator);

        return $this;
    }
}
