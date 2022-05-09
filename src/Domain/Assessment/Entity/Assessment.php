<?php

namespace Core\Domain\Assessment\Entity;

use Core\Domain\Assessment\Factory\AssessmentValidatorFactory;
use Core\Domain\SharedCore\Entity\EntityAbstract;
use Core\Domain\SharedCore\Notification\Notification;
use Core\Domain\SharedCore\Notification\NotificationException;

use function PHPUnit\Framework\throwException;

class Assessment extends EntityAbstract
{

    protected float $averageGrade;

    public function __construct(
        protected string $videoId = '',
        protected array $votesPerGrade = []
    ) {
        parent::__construct(new Notification());

        $this->averageGrade = $this->getAverageGrade();

        $this->validate();
    }

    protected function getAverageGrade(): float
    {

        $dividend = 0;
        $divider = 0;

        foreach ($this->votesPerGrade as $grade => $votes) {
            $dividend += $grade * $votes;
            $divider += $votes;
        }

        if ($divider === 0) return 0;

        return number_format($dividend / $divider, 1);
    }

    public function validate(): void
    {
        AssessmentValidatorFactory::create()->Validate($this);

        if ($this->notification->hasErrors()) {
            throw new NotificationException($this->notification->getErrors());
        }
    }
}
