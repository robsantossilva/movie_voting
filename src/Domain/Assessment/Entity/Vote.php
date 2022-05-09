<?php

namespace Core\Domain\Assessment\Entity;

use Core\Domain\Assessment\Factory\VoteValidatorFactory;
use Core\Domain\SharedCore\Entity\EntityAbstract;
use Core\Domain\SharedCore\Notification\Notification;
use Core\Domain\SharedCore\Notification\NotificationException;

class Vote extends EntityAbstract
{
    public function __construct(
        protected string $videoId = '',
        protected string $userId = '',
        protected int $grade = -1,
        protected string $date = ''
    ) {
        parent::__construct(new Notification());

        $this->validate();
    }

    public function validate(): void
    {
        VoteValidatorFactory::create()->validate($this);

        if ($this->notification->hasErrors())
            throw new NotificationException($this->notification->getErrors());
    }
}
