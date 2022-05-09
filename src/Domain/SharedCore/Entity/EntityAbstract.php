<?php

namespace Core\Domain\SharedCore\Entity;

use Core\Domain\SharedCore\Notification\Notification;
use Exception;

abstract class EntityAbstract
{
    public function __construct(
        public Notification $notification
    ) {
    }

    public function __get($attribute)
    {
        if (isset($this->{$attribute})) {
            return $this->{$attribute};
        }

        throw new Exception("attribute {$attribute} does not exist");
    }

    abstract protected function validate();
}
