<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\UserlandPdoV1\UserlandPdoDecorator;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\UserlandPdoV1\UserlandPdoDecoratorInterface;

trait AwareTrait
{
    protected $UserlandPdoDecorator;

    public function setUserlandPdoDecorator(UserlandPdoDecoratorInterface $UserlandPdoDecorator): self
    {
        if ($this->hasUserlandPdoDecorator()) {
            throw new LogicException('UserlandPdoDecorator is already set.');
        }
        $this->UserlandPdoDecorator = $UserlandPdoDecorator;

        return $this;
    }

    protected function getUserlandPdoDecorator(): UserlandPdoDecoratorInterface
    {
        if (!$this->hasUserlandPdoDecorator()) {
            throw new LogicException('UserlandPdoDecorator is not set.');
        }

        return $this->UserlandPdoDecorator;
    }

    protected function hasUserlandPdoDecorator(): bool
    {
        return isset($this->UserlandPdoDecorator);
    }

    protected function unsetUserlandPdoDecorator(): self
    {
        if (!$this->hasUserlandPdoDecorator()) {
            throw new LogicException('UserlandPdoDecorator is not set.');
        }
        unset($this->UserlandPdoDecorator);

        return $this;
    }
}
