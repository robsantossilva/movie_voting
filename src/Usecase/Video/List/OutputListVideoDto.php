<?php

namespace Core\Usecase\Video\List;

class OutputListVideoDto
{
    public function __construct(
        public string $id = '',
        public string $title = '',
        public string $description = '',
        public array $genres = [],
        public array $castMembers = [],
        public string $rating = '', //L, 10, 12, 14, 16, 18
        public float $averageAssessment = 0.0
    ) {
    }
}
