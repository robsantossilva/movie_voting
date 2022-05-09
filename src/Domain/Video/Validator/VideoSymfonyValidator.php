<?php

namespace Core\Domain\Video\Validator;

use Core\Domain\SharedCore\Entity\EntityAbstract;
use Core\Domain\SharedCore\Notification\NotificationErrorProps;
use Core\Domain\SharedCore\Validator\ValidatorInterface;
use Core\Domain\Video\Entity\Video;
use Symfony\Component\Validator\Constraints\NotBlank;
use Symfony\Component\Validator\Constraints\Uuid;
use Symfony\Component\Validator\Validation;

class VideoSymfonyValidator implements ValidatorInterface
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
            ->validate($entity->title, [
                new NotBlank(null, "Title is required")
            ]);

        $arrayValidations[] = Validation::createValidator()
            ->validate($entity->description, [
                new NotBlank(null, "Description is required")
            ]);

        $arrayValidations[] = Validation::createValidator()
            ->validate($entity->genres, [
                new NotBlank(null, "Genres is required")
            ]);

        $arrayValidations[] = Validation::createValidator()
            ->validate($entity->castMembers, [
                new NotBlank(null, "CastMembers is required")
            ]);

        $arrayValidations[] = Validation::createValidator()
            ->validate($entity->rating, [
                new NotBlank(null, "Rating is required")
            ]);

        // $arrayValidations[] = Validation::createValidator()
        //     ->validate($entity->averageAssessment, [
        //         new NotBlank(null, "AverageAssessment is required")
        //     ]);

        foreach ($arrayValidations as $validation) {
            if (count($validation)) {
                foreach ($validation as $error) {
                    $errorProps = new NotificationErrorProps(
                        message: $error->getMessage(),
                        context: 'video'
                    );

                    $entity->notification->addError($errorProps);
                }
            }
        }
    }
}
