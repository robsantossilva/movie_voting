<?php

namespace Core\Domain\Assessment\Repository;

use Core\Domain\Assessment\Entity\Assessment;
use Core\Domain\SharedCore\Entity\EntityAbstract;
use Core\Domain\SharedCore\Repository\RepositoryInterface;

interface AssessmentRepositoryInterface extends RepositoryInterface
{
    public function find(string $videoId): Assessment;
}
