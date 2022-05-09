<?php

namespace Core\Domain\Video\Factory;

use Core\Domain\SharedCore\Validator\ValidatorInterface;
use Core\Domain\Video\Validator\GenreSymfonyValidator;

class GenreValidatorFactory
{
    static public function create(): ValidatorInterface
    {
        return new GenreSymfonyValidator();
    }
}
