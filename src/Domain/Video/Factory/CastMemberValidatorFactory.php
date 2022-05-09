<?php

namespace Core\Domain\Video\Factory;

use Core\Domain\SharedCore\Validator\ValidatorInterface;
use Core\Domain\Video\Validator\CastMemberSymfonyValidator;

class CastMemberValidatorFactory
{
    static public function create(): ValidatorInterface
    {
        return new CastMemberSymfonyValidator();
    }
}
