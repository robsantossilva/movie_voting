<?php

namespace Core\Domain\SharedCore\Validator;

use Core\Domain\SharedCore\Entity\EntityAbstract;

interface ValidatorInterface
{
    public function Validate(EntityAbstract $entity): void;
}
