<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker;

use PDO;

interface ReschedulingDecoratorInterface extends DecoratorInterface
{
    public function setJobTypeCode(string $jobTypeCode): ReschedulingDecoratorInterface;
    public function setPdo(PDO $pdo);
    public function setRescheduleDelaySeconds(int $rescheduleDelaySeconds): ReschedulingDecoratorInterface;
}
