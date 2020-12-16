<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\KojoApi\WorkerService;

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

class StatusLoggingDecorator implements StatusLoggingDecoratorInterface
{
    use Service\AwareTrait;

    private $lastRequestedStatus;

    public function requestRetry(DateTime $retryDateTime): ServiceInterface
    {
        $this->getApiV1WorkerService()->requestRetry($retryDateTime);
        $this->lastRequestedStatus = 'retry';
        return $this;
    }

    public function requestHold(): ServiceInterface
    {
        $this->getApiV1WorkerService()->requestHold();
        $this->lastRequestedStatus = 'hold';
        return $this;
    }

    public function requestCompleteSuccess(): ServiceInterface
    {
        $this->getApiV1WorkerService()->requestCompleteSuccess();
        $this->lastRequestedStatus = 'complete_success';
        return $this;
    }

    public function requestCompleteFailed(): ServiceInterface
    {
        $this->getApiV1WorkerService()->requestCompleteFailed();
        $this->lastRequestedStatus = 'complete_failed';
        return $this;
    }

    public function applyRequest(): ServiceInterface
    {
        $this->getApiV1WorkerService()->applyRequest();
        $this->logStatus($this->lastRequestedStatus);
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

    public function setServiceUpdateRetryFactory(
        Retry\FactoryInterface $updateRetryFactory
    ): StatusLoggingDecorator {
        $this->getApiV1WorkerService()->setServiceUpdateRetryFactory($updateRetryFactory);
        return $this;
    }

    public function setServiceUpdateCompleteSuccessFactory(
        Success\FactoryInterface $updateCompleteSuccessFactory
    ): StatusLoggingDecorator {
        $this->getApiV1WorkerService()->setServiceUpdateCompleteSuccessFactory($updateCompleteSuccessFactory);
        return $this;
    }

    public function setServiceUpdateCompleteFailedFactory(
        Failed\FactoryInterface $updateCompleteFailedFactory
    ): StatusLoggingDecorator {
        $this->getApiV1WorkerService()->setServiceUpdateCompleteFailedFactory($updateCompleteFailedFactory);
        return $this;
    }

    public function setServiceUpdateHoldFactory(
        Hold\FactoryInterface $updateHoldFactory
    ): StatusLoggingDecorator {
        $this->getApiV1WorkerService()->setServiceUpdateHoldFactory($updateHoldFactory);
        return $this;
    }

    public function setApmNewRelic(Apm\NewRelicInterface $newRelic): StatusLoggingDecorator
    {
        $this->getApiV1WorkerService()->setApmNewRelic($newRelic);
        return $this;
    }

    public function setJob(JobInterface $job): StatusLoggingDecorator
    {
        $this->getApiV1WorkerService()->setJob($job);
        return $this;
    }

    private function logStatus(string $status): StatusLoggingDecorator
    {
        $context = [
            'status' => $status,
            'job_id' => $this->getJobId()
        ];
        $this->getLogger()->notice('task_status', $context);

        return $this;
    }
}
