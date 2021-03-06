<?php

declare(strict_types=1);

namespace Neighborhoods\BuphaloTemplateTree\PrimaryActorName;

use Neighborhoods\Kojo\Api;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1\Worker\DecoratorInterface;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1\Worker;

class Builder implements BuilderInterface
{
    use Api\V1\Worker\Service\AwareTrait;
    use Api\V1\RDBMS\Connection\Service\AwareTrait;
    use Factory\AwareTrait;
    use Worker\AwareTrait;

    public function build(): DecoratorInterface
    {
        $decorator = $this->getPrimaryActorNameFactory()
            ->create();

        $decorator->setApiV1RDBMSConnectionService($this->getApiV1RDBMSConnectionService());
        $decorator->setApiV1WorkerService($this->getApiV1WorkerService());
        $decorator->setWorkerDecorationV1Worker($this->getWorkerDecorationV1Worker());

        return $decorator;
    }
}
