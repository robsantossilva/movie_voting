<?php

namespace Core\Usecase\Video\Create;

use Core\Domain\Video\Factory\VideoFactory;
use Core\Domain\Video\Repository\VideoRepositoryInterface;

class CreateVideoUsecase
{
    public function __construct(
        protected VideoRepositoryInterface $repository
    ) {
    }
    public function execute(InputCreateVideoDto $input): OutputCreateVideoDto
    {
        $video = VideoFactory::create(
            title: $input->title,
            description: $input->description,
            genres: $input->genres,
            castMembers: $input->castMembers,
            rating: $input->rating,
            averageAssessment: $input->averageAssessment
        );

        $this->repository->create($video);

        return new OutputCreateVideoDto(
            id: $video->id,
            title: $video->title,
            description: $video->description,
            genres: $video->genres,
            castMembers: $video->castMembers,
            rating: $video->rating,
            averageAssessment: $video->averageAssessment
        );
    }
}
