<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\UserlandPdoV1\UserlandPdoDecorator\Builder;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1Decorators\UserlandPdoV1\UserlandPdoDecorator\BuilderInterface;

trait AwareTrait
{
    protected $WorkerV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilder;

    public function setWorkerV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilder(BuilderInterface $UserlandPdoDecoratorBuilder): self
    {
        if ($this->hasWorkerV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilder()) {
            throw new LogicException('WorkerV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilder is already set.');
        }
        $this->WorkerV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilder = $UserlandPdoDecoratorBuilder;

        return $this;
    }

    protected function getWorkerV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilder(): BuilderInterface
    {
        if (!$this->hasWorkerV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilder()) {
            throw new LogicException('WorkerV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilder is not set.');
        }

        return $this->WorkerV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilder;
    }

    protected function hasWorkerV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilder(): bool
    {
        return isset($this->WorkerV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilder);
    }

    protected function unsetWorkerV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilder(): self
    {
        if (!$this->hasWorkerV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilder()) {
            throw new LogicException('WorkerV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilder is not set.');
        }
        unset($this->WorkerV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilder);

        return $this;
    }
}
