<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\UserlandPdoV1\UserlandPdoDecorator\Builder;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\UserlandPdoV1\UserlandPdoDecorator\BuilderInterface;

trait AwareTrait
{
    protected $UserlandPdoDecoratorBuilder;

    public function setUserlandPdoDecoratorBuilder(BuilderInterface $UserlandPdoDecoratorBuilder): self
    {
        if ($this->hasUserlandPdoDecoratorBuilder()) {
            throw new LogicException('UserlandPdoDecoratorBuilder is already set.');
        }
        $this->UserlandPdoDecoratorBuilder = $UserlandPdoDecoratorBuilder;

        return $this;
    }

    protected function getUserlandPdoDecoratorBuilder(): BuilderInterface
    {
        if (!$this->hasUserlandPdoDecoratorBuilder()) {
            throw new LogicException('UserlandPdoDecoratorBuilder is not set.');
        }

        return $this->UserlandPdoDecoratorBuilder;
    }

    protected function hasUserlandPdoDecoratorBuilder(): bool
    {
        return isset($this->UserlandPdoDecoratorBuilder);
    }

    protected function unsetUserlandPdoDecoratorBuilder(): self
    {
        if (!$this->hasUserlandPdoDecoratorBuilder()) {
            throw new LogicException('UserlandPdoDecoratorBuilder is not set.');
        }
        unset($this->UserlandPdoDecoratorBuilder);

        return $this;
    }
}
