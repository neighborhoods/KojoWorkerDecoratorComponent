<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\UserlandPdoV1\UserlandPdoDecorator\Builder\Factory;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\UserlandPdoV1\UserlandPdoDecorator\Builder\FactoryInterface;

trait AwareTrait
{
    protected $WorkerV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilderFactory;

    public function setWorkerV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilderFactory(FactoryInterface $UserlandPdoDecoratorBuilderFactory): self
    {
        if ($this->hasWorkerV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilderFactory()) {
            throw new LogicException('WorkerV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilderFactory is already set.');
        }
        $this->WorkerV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilderFactory = $UserlandPdoDecoratorBuilderFactory;

        return $this;
    }

    protected function getWorkerV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilderFactory(): FactoryInterface
    {
        if (!$this->hasWorkerV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilderFactory()) {
            throw new LogicException('WorkerV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilderFactory is not set.');
        }

        return $this->WorkerV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilderFactory;
    }

    protected function hasWorkerV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilderFactory(): bool
    {
        return isset($this->WorkerV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilderFactory);
    }

    protected function unsetWorkerV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilderFactory(): self
    {
        if (!$this->hasWorkerV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilderFactory()) {
            throw new LogicException('WorkerV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilderFactory is not set.');
        }
        unset($this->WorkerV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilderFactory);

        return $this;
    }
}
