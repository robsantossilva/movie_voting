<?php

namespace Core\Domain\Video\Factory;

use Core\Domain\SharedCore\Validator\ValidatorInterface;
use Core\Domain\Video\Validator\VideoSymfonyValidator;

class VideoValidatorFactory
{
    static public function create(): ValidatorInterface
    {
        return new VideoSymfonyValidator();
    }
}
