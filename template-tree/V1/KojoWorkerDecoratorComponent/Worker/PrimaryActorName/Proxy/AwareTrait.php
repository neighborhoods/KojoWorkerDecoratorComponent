<?php

declare(strict_types=1);

namespace Neighborhoods\BuphaloTemplateTree\PrimaryActorName\Proxy;

use LogicException;
use Neighborhoods\BuphaloTemplateTree\PrimaryActorName\ProxyInterface;

/** @codeCoverageIgnore */
trait AwareTrait
{
    protected $PrimaryActorNameProxy;

    public function setPrimaryActorNameProxy(ProxyInterface $PrimaryActorNameProxy): self
    {
        assert(
            !$this->hasPrimaryActorNameProxy(),
            new LogicException('PrimaryActorNameProxy is already set.')
        );
        $this->PrimaryActorNameProxy = $PrimaryActorNameProxy;

        return $this;
    }

    protected function getPrimaryActorNameProxy(): ProxyInterface
    {
        assert($this->hasPrimaryActorNameProxy(), new LogicException('PrimaryActorNameProxy is not set.'));

        return $this->PrimaryActorNameProxy;
    }

    protected function hasPrimaryActorNameProxy(): bool
    {
        return isset($this->PrimaryActorNameProxy);
    }

    protected function unsetPrimaryActorNameProxy(): self
    {
        assert($this->hasPrimaryActorNameProxy(), new LogicException('PrimaryActorNameProxy is not set.'));
        unset($this->PrimaryActorNameProxy);

        return $this;
    }
}
