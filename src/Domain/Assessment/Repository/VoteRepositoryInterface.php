<?php

namespace Core\Domain\Assessment\Repository;

use Core\Domain\SharedCore\Repository\RepositoryInterface;

interface VoteRepositoryInterface extends RepositoryInterface
{
    public function findVotesPerGrade(string $videId): array;
}
