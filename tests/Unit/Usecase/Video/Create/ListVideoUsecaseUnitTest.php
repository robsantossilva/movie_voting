<?php

namespace Tests\Unit\Usecase\Video\Create;

use Core\Domain\Video\Entity\Video;
use Core\Domain\Video\Repository\VideoRepositoryInterface;

use Core\Usecase\Video\List\InputListVideoDto;
use Core\Usecase\Video\List\ListVideoUsecase;
use Core\Usecase\Video\List\OutputListVideoDto;
use PHPUnit\Framework\TestCase;

class ListVideoUsecaseUnitTest extends TestCase
{
    public function testCreateVideo()
    {

        $videoRepository = $this->getMockBuilder(VideoRepositoryInterface::class)
            ->setMethods(['create', 'update', 'find', 'findAll'])
            ->getMock();
        $videoRepository
            ->expects($this->once())
            ->method('findAll')
            ->withAnyParameters()
            ->willReturn([
                new Video(
                    id: "123",
                    title: 'Spider Man 3',
                    description: 'Desc Spider Man 3',
                    genres: ['genre1', 'genre2'],
                    castMembers: ['cast_member1', 'cast_member2'],
                    rating: 'L', //L, 10, 12, 14, 16, 18
                    averageAssessment: 4
                )
            ]);

        /**
         * @var VideoRepositoryInterface $videoRepository
         */
        $listVideoUseCase = new ListVideoUsecase($videoRepository);

        $input = new InputListVideoDto();

        $output = $listVideoUseCase->execute($input);

        $this->assertInstanceOf(OutputListVideoDto::class, $output[0]);
        $this->assertEquals("123", $output[0]->id);
        $this->assertEquals('Spider Man 3', $output[0]->title);
        $this->assertEquals('Desc Spider Man 3', $output[0]->description);
        $this->assertEquals(['genre1', 'genre2'], $output[0]->genres);
        $this->assertEquals(['cast_member1', 'cast_member2'], $output[0]->castMembers);
        $this->assertEquals('L', $output[0]->rating);
        $this->assertEquals(4, $output[0]->averageAssessment);
    }
}
