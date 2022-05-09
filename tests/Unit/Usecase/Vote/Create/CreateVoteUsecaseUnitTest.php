<?php

namespace Tests\Unit\Usecase\Vote\Create;

use Core\Domain\Assessment\Entity\Assessment;
use Core\Domain\Assessment\Repository\AssessmentRepositoryInterface;
use Core\Domain\Assessment\Repository\VoteRepositoryInterface;
use Core\Usecase\Vote\Create\CreateVoteUsecase;
use Core\Usecase\Vote\Create\InputCreateVoteDto;
use Core\Usecase\Vote\Create\OutputCreateVoteDto;
use DateTime;
use PHPUnit\Framework\TestCase;

class CreateVoteUsecaseUnitTest extends TestCase
{
    public function testCreateVote()
    {

        $input = new InputCreateVoteDto(
            videoId: "123",
            userId: "456",
            grade: 2
        );

        $votesPerGradeExpected = [
            1 => 0,
            2 => 1,
            3 => 0,
            4 => 0,
            5 => 0
        ];

        $assessmentReturnMock = new Assessment(
            videoId: "123",
            votesPerGrade: $votesPerGradeExpected
        );

        $voteRepository = $this->buildVoteRepository($votesPerGradeExpected);
        $assessmentRepository = $this->buildAssessmentRepository($assessmentReturnMock);

        $createVoteUsecase = new CreateVoteUsecase($voteRepository, $assessmentRepository);

        $output = $createVoteUsecase->execute($input);

        $this->assertInstanceOf(OutputCreateVoteDto::class, $output);
        $this->assertEquals('123', $output->videoId);
        $this->assertEquals('456', $output->userId);
        $this->assertEquals(2, $output->grade);
        $this->assertTrue($this->validateDateFormat($output->date));
        $this->assertEquals($votesPerGradeExpected, $output->votesPerGrade);
        $this->assertEquals(2, $output->averageGrade);
    }


    public function buildVoteRepository(array $votesPerPage): VoteRepositoryInterface
    {
        $repository = $this->getMockBuilder(VoteRepositoryInterface::class)
            ->setMethods(['create', 'update', 'find', 'findAll', 'findVotesPerGrade'])
            ->getMock();

        $repository
            ->expects($this->once())
            ->method('create')
            ->withAnyParameters();

        $repository
            ->expects($this->once())
            ->method('findVotesPerGrade')
            ->withAnyParameters()
            ->willReturn($votesPerPage);
        /**
         * @var VoteRepositoryInterface $repository
         */
        return $repository;
    }

    public function buildAssessmentRepository(Assessment $assessment): AssessmentRepositoryInterface
    {
        $repository = $this->getMockBuilder(AssessmentRepositoryInterface::class)
            ->setMethods(['create', 'update', 'find', 'findAll'])
            ->getMock();
        $repository
            ->expects($this->once())
            ->method('update')
            ->withAnyParameters();

        /**
         * @var AssessmentRepositoryInterface $repository
         */
        return $repository;
    }

    function validateDateFormat($date, $format = 'Y-m-d H:i:s')
    {
        $d = DateTime::createFromFormat($format, $date);
        // The Y ( 4 digits year ) returns TRUE for any integer with any number of digits so changing the comparison from == to === fixes the issue.
        return $d && $d->format($format) === $date;
    }
}
