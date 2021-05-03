<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\UserlandPdoV1\UserlandPdoDecorator\Builder\Factory;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\UserlandPdoV1\UserlandPdoDecorator\Builder\FactoryInterface;

trait AwareTrait
{
    protected $WorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilderFactory;

    public function setWorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilderFactory(FactoryInterface $UserlandPdoDecoratorBuilderFactory): self
    {
        if ($this->hasWorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilderFactory()) {
            throw new LogicException('WorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilderFactory is already set.');
        }
        $this->WorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilderFactory = $UserlandPdoDecoratorBuilderFactory;

        return $this;
    }

    protected function getWorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilderFactory(): FactoryInterface
    {
        if (!$this->hasWorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilderFactory()) {
            throw new LogicException('WorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilderFactory is not set.');
        }

        return $this->WorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilderFactory;
    }

    protected function hasWorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilderFactory(): bool
    {
        return isset($this->WorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilderFactory);
    }

    protected function unsetWorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilderFactory(): self
    {
        if (!$this->hasWorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilderFactory()) {
            throw new LogicException('WorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilderFactory is not set.');
        }
        unset($this->WorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilderFactory);

        return $this;
    }
}
