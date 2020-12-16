<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\KojoApi\WorkerService\Decorator;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\KojoApi\WorkerService\DecoratorInterface;

trait AwareTrait
{
    protected $KojoApiWorkerServiceDecorator;

    public function setKojoApiWorkerServiceDecorator(DecoratorInterface $Decorator): self
    {
        if ($this->hasKojoApiWorkerServiceDecorator()) {
            throw new LogicException('KojoApiWorkerServiceDecorator is already set.');
        }
        $this->KojoApiWorkerServiceDecorator = $Decorator;

        return $this;
    }

    protected function getKojoApiWorkerServiceDecorator(): DecoratorInterface
    {
        if (!$this->hasKojoApiWorkerServiceDecorator()) {
            throw new LogicException('KojoApiWorkerServiceDecorator is not set.');
        }

        return $this->KojoApiWorkerServiceDecorator;
    }

    protected function hasKojoApiWorkerServiceDecorator(): bool
    {
        return isset($this->KojoApiWorkerServiceDecorator);
    }

    protected function unsetKojoApiWorkerServiceDecorator(): self
    {
        if (!$this->hasKojoApiWorkerServiceDecorator()) {
            throw new LogicException('KojoApiWorkerServiceDecorator is not set.');
        }
        unset($this->KojoApiWorkerServiceDecorator);

        return $this;
    }
}
