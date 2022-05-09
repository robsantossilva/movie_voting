<?php

namespace Core\Usecase\Vote\Create;

use Core\Domain\Assessment\Entity\Assessment;
use Core\Domain\Assessment\Factory\VoteFactory;
use Core\Domain\Assessment\Repository\AssessmentRepositoryInterface;
use Core\Domain\Assessment\Repository\VoteRepositoryInterface;

class CreateVoteUsecase
{
    public function __construct(
        protected VoteRepositoryInterface $voteRepository,
        protected AssessmentRepositoryInterface $assessmentRepository
    ) {
    }

    public function execute(InputCreateVoteDto $input): OutputCreateVoteDto
    {

        $vote = VoteFactory::create(
            videoId: $input->videoId,
            userId: $input->userId,
            grade: $input->grade
        );

        $this->voteRepository->create($vote);

        //### Esse bloco pode se tornar um outro usecase UpdateAssessmentUseCase
        // Acionado por um evento para atualizar o Assessment
        $votesPerGrade = $this->voteRepository->findVotesPerGrade($vote->videoId);
        $assessment = new Assessment(
            videoId: $input->videoId,
            votesPerGrade: $votesPerGrade
        );
        $this->assessmentRepository->update($assessment);
        //###

        return new OutputCreateVoteDto(
            videoId: $input->videoId,
            userId: $input->userId,
            grade: $input->grade,
            date: $vote->date,
            votesPerGrade: $assessment->votesPerGrade,
            averageGrade: $assessment->averageGrade
        );
    }
}
