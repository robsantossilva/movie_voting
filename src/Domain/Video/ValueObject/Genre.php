<?php

namespace Core\Domain\Video\ValueObject;

use Core\Domain\SharedCore\Entity\EntityAbstract;
use Core\Domain\SharedCore\Notification\Notification;
use Core\Domain\SharedCore\Notification\NotificationException;
use Core\Domain\Video\Factory\GenreValidatorFactory;

class Genre extends EntityAbstract
{
    public function __construct(
        protected string $id = '',
        protected string $name = '',
        protected string $description = ''
    ) {
        parent::__construct(new Notification());

        $this->validate();
    }

    public function update(
        string $name = '',
        string $description = ''
    ) {
        $this->name = $name !== '' ? $name : $this->name;
        $this->description = $description !== '' ? $description : $this->description;

        $this->validate();
    }

    protected function validate()
    {
        GenreValidatorFactory::create()->Validate($this);

        if ($this->notification->hasErrors()) {
            throw new NotificationException($this->notification->getErrors());
        }
    }
}
