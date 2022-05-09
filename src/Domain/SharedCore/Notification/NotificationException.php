<?php

namespace Core\Domain\SharedCore\Notification;

use Exception;

class NotificationException extends Exception
{
    public function __construct(
        public array $errors
    ) {

        parent::__construct(
            implode(
                ", ",
                array_map(function (NotificationErrorProps $error) {
                    return $error->context . ": " . $error->message;
                }, $errors)
            )
        );
    }
}
