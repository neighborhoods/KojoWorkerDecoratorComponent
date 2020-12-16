<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\KojoApi\WorkerService\Decorator\Factory;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\KojoApi\WorkerService\Decorator\FactoryInterface;

trait AwareTrait
{
    protected $KojoApiWorkerServiceDecoratorFactory;

    public function setKojoApiWorkerServiceDecoratorFactory(FactoryInterface $DecoratorFactory): self
    {
        if ($this->hasKojoApiWorkerServiceDecoratorFactory()) {
            throw new LogicException('KojoApiWorkerServiceDecoratorFactory is already set.');
        }
        $this->KojoApiWorkerServiceDecoratorFactory = $DecoratorFactory;

        return $this;
    }

    protected function getKojoApiWorkerServiceDecoratorFactory(): FactoryInterface
    {
        if (!$this->hasKojoApiWorkerServiceDecoratorFactory()) {
            throw new LogicException('KojoApiWorkerServiceDecoratorFactory is not set.');
        }

        return $this->KojoApiWorkerServiceDecoratorFactory;
    }

    protected function hasKojoApiWorkerServiceDecoratorFactory(): bool
    {
        return isset($this->KojoApiWorkerServiceDecoratorFactory);
    }

    protected function unsetKojoApiWorkerServiceDecoratorFactory(): self
    {
        if (!$this->hasKojoApiWorkerServiceDecoratorFactory()) {
            throw new LogicException('KojoApiWorkerServiceDecoratorFactory is not set.');
        }
        unset($this->KojoApiWorkerServiceDecoratorFactory);

        return $this;
    }
}
