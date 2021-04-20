<?php

declare(strict_types=1);

namespace Neighborhoods\KojoWorkerDecoratorComponent\Worker;

use DateInterval;
use DateTime;
use InvalidArgumentException;
use LogicException;
use Neighborhoods\ExceptionComponent\Exception;
use Neighborhoods\ExceptionComponent\TransientExceptionInterface;
use Neighborhoods\Kojo\Api;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1\Worker;
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerV1\WorkerInterface;
use Neighborhoods\ThrowableDiagnosticComponent\DiagnosedInterface;
use Psr\Log\LogLevel;
use Throwable;

class ExceptionHandlingDecorator implements ExceptionHandlingDecoratorInterface
{
    use Worker\DecoratorTrait;

    /**
     * @var DateInterval|null
     */
    private $interval;

    public function work(): WorkerInterface
    {
        try {
            $this->runWorker();
        } catch (TransientExceptionInterface $transientException) {
            $this->getApiV1WorkerService()
                ->requestRetry((new DateTime())->add($this->getInterval()))
                ->applyRequest();
            $this->logThrowable($transientException, LogLevel::WARNING);
        } catch (DiagnosedInterface $diagnosed) {
            $logLevel = LogLevel::CRITICAL;
            if ($diagnosed->isTransient()) {
                $this->getApiV1WorkerService()
                    ->requestRetry((new DateTime())->add($this->getInterval()))
                    ->applyRequest();
                $logLevel = LogLevel::WARNING;
            } else {
                $this->getApiV1WorkerService()
                    ->requestHold()
                    ->applyRequest();
            }
            $this->logThrowable($diagnosed, $logLevel);
        } catch (Throwable $throwable) {
            $this->getApiV1WorkerService()
                ->requestHold()
                ->applyRequest();
            $this->logThrowable($throwable, LogLevel::CRITICAL);
        }

        return $this;
    }

    private function logThrowable(Throwable $throwable, string $logLevel): void
    {
        $message = $throwable->getMessage();
        if ($throwable instanceof Exception) {
            $message = json_encode($throwable->getMessages());
            if (false === $message) {
                $message = '';
            }
        }
        $context = [
            'job_id' => $this->getApiV1WorkerService()->getJobId(),
            'exception' => $throwable,
        ];
        $this->getApiV1WorkerService()->getLogger()->log($logLevel, $message, $context);
    }

    public function setRetryIntervalDefinition(string $intervalDefinition): self
    {
        if (isset($this->interval)) {
            throw new LogicException('Interval is already set');
        }
        try {
            $this->interval = new DateInterval($intervalDefinition);
        } catch (Throwable $exception) {
            throw new InvalidArgumentException('Invalid interval definition provided', 0, $exception);
        }

        return $this;
    }

    public function unsetInterval(): self
    {
        if (!isset($this->interval)) {
            throw new LogicException('Interval is not set');
        }
        $this->interval = null;

        return $this;
    }

    public function getInterval(): DateInterval
    {
        if (!isset($this->interval)) {
            throw new LogicException('Interval is not set');
        }

        return $this->interval;
    }
}
