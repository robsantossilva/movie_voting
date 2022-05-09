<?php

namespace Core\Domain\Assessment\Factory;

use Core\Domain\Assessment\Entity\Vote;

class VoteFactory
{
    static public function create(
        string $videoId = '',
        string $userId = '',
        int $grade = 0
    ): Vote {
        return new Vote(
            videoId: $videoId,
            userId: $userId,
            grade: $grade,
            date: date("Y-m-d H:i:s")
        );
    }
}
