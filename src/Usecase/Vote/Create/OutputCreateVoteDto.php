<?php

namespace Core\Usecase\Vote\Create;

class OutputCreateVoteDto
{
    public function __construct(
        public string $videoId = '',
        public string $userId = '',
        public int $grade = 0,
        public string $date = '',
        public array $votesPerGrade = [],
        public float $averageGrade = 0.0
    ) {
    }
}
