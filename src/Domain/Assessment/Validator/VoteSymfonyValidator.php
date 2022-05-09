<?php

namespace Core\Domain\Assessment\Validator;

use Core\Domain\SharedCore\Entity\EntityAbstract;
use Core\Domain\SharedCore\Notification\NotificationErrorProps;
use Core\Domain\SharedCore\Validator\ValidatorInterface;
use Core\Domain\Video\Entity\Video;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\PositiveOrZero;
use Symfony\Component\Validator\Validation;

class VoteSymfonyValidator implements ValidatorInterface
{
    /**
     * @var Video $entity
     */
    public function Validate(EntityAbstract $entity): void
    {

        $arrayValidations = [];

        $arrayValidations[] = Validation::createValidator()
            ->validate($entity->videoId, [
                new NotBlank(null, "VideoId is required")
            ]);

        $arrayValidations[] = Validation::createValidator()
            ->validate($entity->userId, [
                new NotBlank(null, "UserId is required")
            ]);

        $arrayValidations[] = Validation::createValidator()
            ->validate($entity->grade, [
                new PositiveOrZero(null, "Grade is required")
            ]);

        $arrayValidations[] = Validation::createValidator()
            ->validate($entity->date, [
                new NotBlank(null, "Date is required")
            ]);

        foreach ($arrayValidations as $validation) {
            if (count($validation)) {
                foreach ($validation as $error) {
                    $errorProps = new NotificationErrorProps(
                        message: $error->getMessage(),
                        context: 'vote'
                    );

                    $entity->notification->addError($errorProps);
                }
            }
        }
    }
}
