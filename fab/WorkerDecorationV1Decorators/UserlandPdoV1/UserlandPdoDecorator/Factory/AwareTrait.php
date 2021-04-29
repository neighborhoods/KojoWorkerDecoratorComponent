<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\UserlandPdoV1\UserlandPdoDecorator\Factory;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\UserlandPdoV1\UserlandPdoDecorator\FactoryInterface;

trait AwareTrait
{
    protected $WorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecoratorFactory;

    public function setWorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecoratorFactory(FactoryInterface $UserlandPdoDecoratorFactory): self
    {
        if ($this->hasWorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecoratorFactory()) {
            throw new LogicException('WorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecoratorFactory is already set.');
        }
        $this->WorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecoratorFactory = $UserlandPdoDecoratorFactory;

        return $this;
    }

    protected function getWorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecoratorFactory(): FactoryInterface
    {
        if (!$this->hasWorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecoratorFactory()) {
            throw new LogicException('WorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecoratorFactory is not set.');
        }

        return $this->WorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecoratorFactory;
    }

    protected function hasWorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecoratorFactory(): bool
    {
        return isset($this->WorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecoratorFactory);
    }

    protected function unsetWorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecoratorFactory(): self
    {
        if (!$this->hasWorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecoratorFactory()) {
            throw new LogicException('WorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecoratorFactory is not set.');
        }
        unset($this->WorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecoratorFactory);

        return $this;
    }
}
