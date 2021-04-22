<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\UserlandPdoV1\UserlandPdoDecorator\Factory;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\UserlandPdoV1\UserlandPdoDecorator\FactoryInterface;

trait AwareTrait
{
    protected $WorkerV1DecoratorsUserlandPdoV1UserlandPdoDecoratorFactory;

    public function setWorkerV1DecoratorsUserlandPdoV1UserlandPdoDecoratorFactory(FactoryInterface $UserlandPdoDecoratorFactory): self
    {
        if ($this->hasWorkerV1DecoratorsUserlandPdoV1UserlandPdoDecoratorFactory()) {
            throw new LogicException('WorkerV1DecoratorsUserlandPdoV1UserlandPdoDecoratorFactory is already set.');
        }
        $this->WorkerV1DecoratorsUserlandPdoV1UserlandPdoDecoratorFactory = $UserlandPdoDecoratorFactory;

        return $this;
    }

    protected function getWorkerV1DecoratorsUserlandPdoV1UserlandPdoDecoratorFactory(): FactoryInterface
    {
        if (!$this->hasWorkerV1DecoratorsUserlandPdoV1UserlandPdoDecoratorFactory()) {
            throw new LogicException('WorkerV1DecoratorsUserlandPdoV1UserlandPdoDecoratorFactory is not set.');
        }

        return $this->WorkerV1DecoratorsUserlandPdoV1UserlandPdoDecoratorFactory;
    }

    protected function hasWorkerV1DecoratorsUserlandPdoV1UserlandPdoDecoratorFactory(): bool
    {
        return isset($this->WorkerV1DecoratorsUserlandPdoV1UserlandPdoDecoratorFactory);
    }

    protected function unsetWorkerV1DecoratorsUserlandPdoV1UserlandPdoDecoratorFactory(): self
    {
        if (!$this->hasWorkerV1DecoratorsUserlandPdoV1UserlandPdoDecoratorFactory()) {
            throw new LogicException('WorkerV1DecoratorsUserlandPdoV1UserlandPdoDecoratorFactory is not set.');
        }
        unset($this->WorkerV1DecoratorsUserlandPdoV1UserlandPdoDecoratorFactory);

        return $this;
    }
}
