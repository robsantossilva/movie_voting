<?php

namespace Core\Domain\Assessment\Factory;

use Core\Domain\Assessment\Validator\AssessmentSymfonyValidator;
use Core\Domain\SharedCore\Validator\ValidatorInterface;

class AssessmentValidatorFactory
{
    static public function create(): ValidatorInterface
    {
        return new AssessmentSymfonyValidator();
    }
}
