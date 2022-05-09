<?php

namespace Core\Domain\Assessment\Factory;

use Core\Domain\Assessment\Validator\VoteSymfonyValidator;
use Core\Domain\SharedCore\Validator\ValidatorInterface;

class VoteValidatorFactory
{
    static public function create(): ValidatorInterface
    {
        return new VoteSymfonyValidator();
    }
}
