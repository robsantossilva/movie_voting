<?php

namespace Core\Domain\Video\Factory;

use Core\Domain\Video\Entity\Video;
use Ramsey\Uuid\Uuid;

class VideoFactory
{
    static public function create(
        string $title = '',
        string $description = '',
        array $genres = [],
        array $castMembers = [],
        string $rating = '',
        float $averageAssessment = 0
    ): Video {
        return new Video(
            id: Uuid::uuid4()->toString(),
            title: $title,
            description: $description,
            genres: $genres,
            castMembers: $castMembers,
            rating: $rating, //L, 10, 12, 14, 16, 18
            averageAssessment: $averageAssessment
        );
    }
}
