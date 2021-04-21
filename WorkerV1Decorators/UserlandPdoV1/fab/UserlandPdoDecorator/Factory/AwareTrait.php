<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\UserlandPdoV1\UserlandPdoDecorator\Factory;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\UserlandPdoV1\UserlandPdoDecorator\FactoryInterface;

trait AwareTrait
{
    protected $UserlandPdoDecoratorFactory;

    public function setUserlandPdoDecoratorFactory(FactoryInterface $UserlandPdoDecoratorFactory): self
    {
        if ($this->hasUserlandPdoDecoratorFactory()) {
            throw new LogicException('UserlandPdoDecoratorFactory is already set.');
        }
        $this->UserlandPdoDecoratorFactory = $UserlandPdoDecoratorFactory;

        return $this;
    }

    protected function getUserlandPdoDecoratorFactory(): FactoryInterface
    {
        if (!$this->hasUserlandPdoDecoratorFactory()) {
            throw new LogicException('UserlandPdoDecoratorFactory is not set.');
        }

        return $this->UserlandPdoDecoratorFactory;
    }

    protected function hasUserlandPdoDecoratorFactory(): bool
    {
        return isset($this->UserlandPdoDecoratorFactory);
    }

    protected function unsetUserlandPdoDecoratorFactory(): self
    {
        if (!$this->hasUserlandPdoDecoratorFactory()) {
            throw new LogicException('UserlandPdoDecoratorFactory is not set.');
        }
        unset($this->UserlandPdoDecoratorFactory);

        return $this;
    }
}
