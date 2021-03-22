<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker;

use Doctrine\DBAL\Connection;

interface ReschedulingDecoratorInterface extends DecoratorInterface
{
    public function setJobTypeCode(string $jobTypeCode): ReschedulingDecoratorInterface;
    public function setConnection(Connection $connection): ReschedulingDecoratorInterface;
    public function setRescheduleDelaySeconds(int $rescheduleDelaySeconds): ReschedulingDecoratorInterface;
}
