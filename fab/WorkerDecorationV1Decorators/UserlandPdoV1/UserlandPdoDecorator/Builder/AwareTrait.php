<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\UserlandPdoV1\UserlandPdoDecorator\Builder;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\UserlandPdoV1\UserlandPdoDecorator\BuilderInterface;

trait AwareTrait
{
    protected $WorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilder;

    public function setWorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilder(BuilderInterface $UserlandPdoDecoratorBuilder): self
    {
        if ($this->hasWorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilder()) {
            throw new LogicException('WorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilder is already set.');
        }
        $this->WorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilder = $UserlandPdoDecoratorBuilder;

        return $this;
    }

    protected function getWorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilder(): BuilderInterface
    {
        if (!$this->hasWorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilder()) {
            throw new LogicException('WorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilder is not set.');
        }

        return $this->WorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilder;
    }

    protected function hasWorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilder(): bool
    {
        return isset($this->WorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilder);
    }

    protected function unsetWorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilder(): self
    {
        if (!$this->hasWorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilder()) {
            throw new LogicException('WorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilder is not set.');
        }
        unset($this->WorkerDecorationV1DecoratorsUserlandPdoV1UserlandPdoDecoratorBuilder);

        return $this;
    }
}
