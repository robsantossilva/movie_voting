<?php

namespace Core\Usecase\Vote\Create;

class InputCreateVoteDto
{
    public function __construct(
        public string $videoId = '',
        public string $userId = '',
        public int $grade = 0
    ) {
    }
}
