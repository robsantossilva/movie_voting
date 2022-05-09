<?php

namespace Tests\Unit\Usecase\Video\Create;

use Core\Domain\Video\Repository\VideoRepositoryInterface;
use Core\Usecase\Video\Create\CreateVideoUsecase;
use Core\Usecase\Video\Create\InputCreateVideoDto;
use Core\Usecase\Video\Create\OutputCreateVideoDto;
use PHPUnit\Framework\TestCase;

class CreateVideoUsecaseUnitTest extends TestCase
{
    public function testCreateVideo()
    {

        $videoRepository = $this->getMockBuilder(VideoRepositoryInterface::class)
            ->setMethods(['create', 'update', 'find', 'findAll'])
            ->getMock();
        $videoRepository
            ->expects($this->once())
            ->method('create')
            ->withAnyParameters();

        /**
         * @var VideoRepositoryInterface $videoRepository
         */
        $createVideoUseCase = new CreateVideoUsecase($videoRepository);

        $input = new InputCreateVideoDto(
            title: 'Spider Man 3',
            description: 'Desc Spider Man 3',
            genres: ['genre1', 'genre2'],
            castMembers: ['cast_member1', 'cast_member2'],
            rating: 'L', //L, 10, 12, 14, 16, 18
            averageAssessment: 4
        );

        $output = $createVideoUseCase->execute($input);

        $this->assertInstanceOf(OutputCreateVideoDto::class, $output);
        $this->assertNotEmpty($output->id);
        $this->assertEquals('Spider Man 3', $output->title);
        $this->assertEquals('Desc Spider Man 3', $output->description);
        $this->assertEquals(['genre1', 'genre2'], $output->genres);
        $this->assertEquals(['cast_member1', 'cast_member2'], $output->castMembers);
        $this->assertEquals('L', $output->rating);
        $this->assertEquals(4, $output->averageAssessment);
    }
}
