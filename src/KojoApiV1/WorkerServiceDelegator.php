<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\KojoApiV1;

use DateTime;
use Neighborhoods\Kojo\Api\V1\Job\SchedulerInterface;
use Neighborhoods\Kojo\Api\V1\LoggerInterface;
use Neighborhoods\Kojo\Api\V1\Worker\Service;
use Neighborhoods\Kojo\Api\V1\Worker\ServiceInterface;
use Neighborhoods\Kojo\Apm;
use Neighborhoods\Kojo\Data\JobInterface;
use Neighborhoods\Kojo\Service\Update\Complete\Failed;
use Neighborhoods\Kojo\Service\Update\Complete\Success;
use Neighborhoods\Kojo\Service\Update\Hold;
use Neighborhoods\Kojo\Service\Update\Retry;

class WorkerServiceDelegator implements ServiceInterface
{
    use Service\AwareTrait;

    public function requestRetry(DateTime $retryDateTime): ServiceInterface
    {
        $this->getApiV1WorkerService()->requestRetry($retryDateTime);
        return $this;
    }

    public function requestHold(): ServiceInterface
    {
        $this->getApiV1WorkerService()->requestHold();
        return $this;
    }

    public function requestCompleteSuccess(): ServiceInterface
    {
        $this->getApiV1WorkerService()->requestCompleteSuccess();
        return $this;
    }

    public function requestCompleteFailed(): ServiceInterface
    {
        $this->getApiV1WorkerService()->requestCompleteFailed();
        return $this;
    }

    public function applyRequest(): ServiceInterface
    {
        $this->getApiV1WorkerService()->applyRequest();
        return $this;
    }

    public function isRequestApplied(): bool
    {
        return $this->getApiV1WorkerService()->isRequestApplied();
    }

    public function getLogger(): LoggerInterface
    {
        return $this->getApiV1WorkerService()->getLogger();
    }

    public function getNewJobScheduler(): SchedulerInterface
    {
        return $this->getApiV1WorkerService()->getNewJobScheduler();
    }

    public function reload(): ServiceInterface
    {
        $this->getApiV1WorkerService()->reload();
        return $this;
    }

    public function getTimesCrashed(): int
    {
        return $this->getApiV1WorkerService()->getTimesCrashed();
    }

    public function getJobId(): int
    {
        return $this->getApiV1WorkerService()->getJobId();
    }

    public function getTimesRetried(): int
    {
        return $this->getApiV1WorkerService()->getTimesRetried();
    }

    public function getNewRelic(): Apm\NewRelicInterface
    {
        return $this->getApiV1WorkerService()->getNewRelic();
    }

    public function setServiceUpdateRetryFactory(Retry\FactoryInterface $updateRetryFactory)
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        throw new ForbiddenUserspaceMethodInvocationException();
    }

    public function setServiceUpdateCompleteSuccessFactory(Success\FactoryInterface $updateCompleteSuccessFactory)
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        throw new ForbiddenUserspaceMethodInvocationException();
    }

    public function setServiceUpdateCompleteFailedFactory(Failed\FactoryInterface $updateCompleteFailedFactory)
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        throw new ForbiddenUserspaceMethodInvocationException();
    }

    public function setServiceUpdateHoldFactory(Hold\FactoryInterface $updateHoldFactory)
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        throw new ForbiddenUserspaceMethodInvocationException();
    }

    public function setApmNewRelic(Apm\NewRelicInterface $newRelic)
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        throw new ForbiddenUserspaceMethodInvocationException();
    }

    public function setJob(JobInterface $job)
    {
        /** @noinspection PhpUnhandledExceptionInspection */
        throw new ForbiddenUserspaceMethodInvocationException();
    }
}
