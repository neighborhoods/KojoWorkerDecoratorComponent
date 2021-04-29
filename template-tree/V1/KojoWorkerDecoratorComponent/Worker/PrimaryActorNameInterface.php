<?php

declare(strict_types=1);

namespace Neighborhoods\BuphaloTemplateTree;

interface PrimaryActorNameInterface extends
    \Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1\WorkerInterface
{
    public const JOB_TYPE_CODE = 'TODO';
}
