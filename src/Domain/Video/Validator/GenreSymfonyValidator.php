<?php

namespace Core\Domain\Video\Validator;

use Core\Domain\SharedCore\Entity\EntityAbstract;
use Core\Domain\SharedCore\Notification\NotificationErrorProps;
use Core\Domain\SharedCore\Validator\ValidatorInterface;
use Core\Domain\Video\Entity\Video;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Uuid;
use Symfony\Component\Validator\Validation;

class GenreSymfonyValidator implements ValidatorInterface
{
    /**
     * @var Video $entity
     */
    public function Validate(EntityAbstract $entity): void
    {

        $arrayValidations = [];

        $arrayValidations[] = Validation::createValidator()
            ->validate($entity->id, [
                new NotBlank(null, "Id is required")
            ]);

        $arrayValidations[] = Validation::createValidator()
            ->validate($entity->name, [
                new NotBlank(null, "Name is required")
            ]);

        $arrayValidations[] = Validation::createValidator()
            ->validate($entity->description, [
                new NotBlank(null, "Description is required")
            ]);

        foreach ($arrayValidations as $validation) {
            if (count($validation)) {
                foreach ($validation as $error) {
                    $errorProps = new NotificationErrorProps(
                        message: $error->getMessage(),
                        context: 'genre'
                    );

                    $entity->notification->addError($errorProps);
                }
            }
        }
    }
}
