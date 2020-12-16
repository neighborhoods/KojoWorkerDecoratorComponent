<?php
declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\KojoApi\WorkerService\StatusLoggingDecorator;

use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\KojoApi\WorkerService\StatusLoggingDecoratorInterface;

trait AwareTrait
{
    protected $KojoApiWorkerServiceStatusLoggingDecorator;

    public function setKojoApiWorkerServiceStatusLoggingDecorator(StatusLoggingDecoratorInterface $StatusLoggingDecorator): self
    {
        if ($this->hasKojoApiWorkerServiceStatusLoggingDecorator()) {
            throw new LogicException('KojoApiWorkerServiceStatusLoggingDecorator is already set.');
        }
        $this->KojoApiWorkerServiceStatusLoggingDecorator = $StatusLoggingDecorator;

        return $this;
    }

    protected function getKojoApiWorkerServiceStatusLoggingDecorator(): StatusLoggingDecoratorInterface
    {
        if (!$this->hasKojoApiWorkerServiceStatusLoggingDecorator()) {
            throw new LogicException('KojoApiWorkerServiceStatusLoggingDecorator is not set.');
        }

        return $this->KojoApiWorkerServiceStatusLoggingDecorator;
    }

    protected function hasKojoApiWorkerServiceStatusLoggingDecorator(): bool
    {
        return isset($this->KojoApiWorkerServiceStatusLoggingDecorator);
    }

    protected function unsetKojoApiWorkerServiceStatusLoggingDecorator(): self
    {
        if (!$this->hasKojoApiWorkerServiceStatusLoggingDecorator()) {
            throw new LogicException('KojoApiWorkerServiceStatusLoggingDecorator is not set.');
        }
        unset($this->KojoApiWorkerServiceStatusLoggingDecorator);

        return $this;
    }
}
