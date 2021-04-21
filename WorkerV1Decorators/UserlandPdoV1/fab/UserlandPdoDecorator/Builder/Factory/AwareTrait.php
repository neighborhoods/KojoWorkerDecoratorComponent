<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\UserlandPdoV1\UserlandPdoDecorator\Builder\Factory;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\UserlandPdoV1\UserlandPdoDecorator\Builder\FactoryInterface;

trait AwareTrait
{
    protected $UserlandPdoDecoratorBuilderFactory;

    public function setUserlandPdoDecoratorBuilderFactory(FactoryInterface $UserlandPdoDecoratorBuilderFactory): self
    {
        if ($this->hasUserlandPdoDecoratorBuilderFactory()) {
            throw new LogicException('UserlandPdoDecoratorBuilderFactory is already set.');
        }
        $this->UserlandPdoDecoratorBuilderFactory = $UserlandPdoDecoratorBuilderFactory;

        return $this;
    }

    protected function getUserlandPdoDecoratorBuilderFactory(): FactoryInterface
    {
        if (!$this->hasUserlandPdoDecoratorBuilderFactory()) {
            throw new LogicException('UserlandPdoDecoratorBuilderFactory is not set.');
        }

        return $this->UserlandPdoDecoratorBuilderFactory;
    }

    protected function hasUserlandPdoDecoratorBuilderFactory(): bool
    {
        return isset($this->UserlandPdoDecoratorBuilderFactory);
    }

    protected function unsetUserlandPdoDecoratorBuilderFactory(): self
    {
        if (!$this->hasUserlandPdoDecoratorBuilderFactory()) {
            throw new LogicException('UserlandPdoDecoratorBuilderFactory is not set.');
        }
        unset($this->UserlandPdoDecoratorBuilderFactory);

        return $this;
    }
}
