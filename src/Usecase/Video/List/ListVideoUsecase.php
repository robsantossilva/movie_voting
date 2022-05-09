<?php

namespace Core\Usecase\Video\List;

use Core\Domain\Video\Repository\VideoRepositoryInterface;
use Core\Usecase\Video\List\InputListVideoDto;
use Core\Usecase\Video\List\OutputListVideoDto;

class ListVideoUsecase
{
    public function __construct(
        protected VideoRepositoryInterface $repository
    ) {
    }
    public function execute(InputListVideoDto $input): array
    {

        $videos = $this->repository->findAll();

        return array_map(function ($video) {
            return new OutputListVideoDto(
                id: $video->id,
                title: $video->title,
                description: $video->description,
                genres: $video->genres,
                castMembers: $video->castMembers,
                rating: $video->rating,
                averageAssessment: $video->averageAssessment
            );
        }, $videos);
    }
}
