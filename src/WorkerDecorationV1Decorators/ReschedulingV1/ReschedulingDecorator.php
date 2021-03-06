<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1Decorators\ReschedulingV1;

use DateTime;
use LogicException;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1\Connection;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1\Worker;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerDecorationV1\WorkerInterface;
use Neighborhoods\ThrowableDiagnosticComponent\ThrowableDiagnosticV1\ThrowableDiagnostic;
use OutOfBoundsException;
use Throwable;

final class ReschedulingDecorator implements ReschedulingDecoratorInterface
{
    use Worker\DecoratorTrait;
    use Connection\PdoAwareTrait;
    use ThrowableDiagnostic\Builder\Factory\AwareTrait;

    private /*int*/ $rescheduleDelaySeconds;
    private /*string*/ $jobTypeCode;

    public function work(): WorkerInterface
    {
        $this->runWorker();

        if ($this->getApiV1WorkerService()->isRequestApplied()) {
            $this->getApiV1WorkerService()
                ->getLogger()
                ->warning('Kojo worker state request already applied, not rescheduling.');
        } else {
            $this->reschedule();
        }

        return $this;
    }

    private function reschedule(): ReschedulingDecoratorInterface
    {
        $this->getPdo()->beginTransaction();
        try {
            $this->getApiV1WorkerService()
                ->getNewJobScheduler()
                ->setJobTypeCode($this->getJobTypeCode())
                ->setWorkAtDateTime(new DateTime(
                    sprintf(
                        '+%d seconds',
                        $this->getRescheduleDelaySeconds()
                    )
                ))
                ->save();

            $this->getApiV1WorkerService()
                ->requestCompleteSuccess()
                ->applyRequest();

            $this->getPdo()->commit();
        } catch (Throwable $throwable) {
            $this->getPdo()->rollBack();
            $this->getThrowableDiagnosticV1ThrowableDiagnosticBuilderFactory()
                ->create()
                ->build()
                ->diagnose($throwable);
        }

        return $this;
    }

    public function setRescheduleDelaySeconds(int $rescheduleDelaySeconds): ReschedulingDecoratorInterface
    {
        if (isset($this->rescheduleDelaySeconds)) {
            throw new LogicException('Reschedule Delay Seconds is already set.');
        }
        if ($rescheduleDelaySeconds < 0) {
            throw new OutOfBoundsException('Reschedule Delay Seconds must be positive');
        }
        $this->rescheduleDelaySeconds = $rescheduleDelaySeconds;
        return $this;
    }

    private function getRescheduleDelaySeconds(): int
    {
        if (!isset($this->rescheduleDelaySeconds)) {
            throw new LogicException('Reschedule Delay Seconds has not been set.');
        }
        return $this->rescheduleDelaySeconds;
    }

    public function setJobTypeCode(string $jobTypeCode): ReschedulingDecoratorInterface
    {
        if (isset($this->jobTypeCode)) {
            throw new LogicException('Job Type Code is already set.');
        }
        $this->jobTypeCode = $jobTypeCode;
        return $this;
    }

    private function getJobTypeCode(): string
    {
        if (!isset($this->jobTypeCode)) {
            throw new LogicException('Job Type Code has not been set.');
        }
        return $this->jobTypeCode;
    }
}
