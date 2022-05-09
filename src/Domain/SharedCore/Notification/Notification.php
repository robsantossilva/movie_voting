<?php

namespace Core\Domain\SharedCore\Notification;

class NotificationErrorProps
{
    public function __construct(
        public string $message,
        public $context
    ) {
    }
}

class Notification
{
    private array $errors = [];

    public function addError(
        NotificationErrorProps $error
    ) {
        array_push($this->errors, $error);
    }

    public function messages(string $context = '')
    {
        $errors = $this->errors;

        if ($context !== '') {
            $errors = array_filter($errors, function ($error) use ($context) {
                return $context === $error->context;
            });
        }

        $arrayError = array_map(function (NotificationErrorProps $error) use ($context) {
            return $error->context . ": " . $error->message;
        }, $errors);

        return implode(", ", $arrayError);
    }

    public function hasErrors(): bool
    {
        return count($this->errors) ? true : false;
    }

    public function getErrors(): array
    {
        return $this->errors;
    }
}
