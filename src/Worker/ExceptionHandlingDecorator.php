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
use Neighborhoods\KojoWorkerDecoratorComponent\WorkerInterface;
use Neighborhoods\ThrowableDiagnosticComponent\DiagnosedInterface;
use Throwable;

class ExceptionHandlingDecorator implements ExceptionHandlingDecoratorInterface
{
    use DecoratorTrait;

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
            $this->logThrowable($transientException);
        } catch (DiagnosedInterface $diagnosed) {
            if ($diagnosed->isTransient()) {
                $this->getApiV1WorkerService()
                    ->requestRetry((new DateTime())->add($this->getInterval()))
                    ->applyRequest();
            } else {
                $this->getApiV1WorkerService()
                    ->requestHold()
                    ->applyRequest();
            }
            $this->logThrowable($diagnosed);
        } catch (Throwable $throwable) {
            $this->getApiV1WorkerService()
                ->requestHold()
                ->applyRequest();
            $this->logThrowable($throwable);
        }

        return $this;
    }

    private function logThrowable(Throwable $throwable): void
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
        $this->getApiV1WorkerService()->getLogger()->alert($message, $context);
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
