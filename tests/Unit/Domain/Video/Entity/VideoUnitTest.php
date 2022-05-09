<?php

namespace Tests\Unit\Domain\Video\Entity;

use Core\Domain\Video\Entity\Video;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\Uuid;

class VideoUnitTest extends TestCase
{
    public function testVideoAttributes()
    {

        $uuid = Uuid::v4();

        $video = new Video(
            id: $uuid,
            title: 'Spider Man 3',
            description: 'Desc Spider Man 3',
            genres: ['genre1', 'genre2'],
            castMembers: ['cast_member1', 'cast_member2'],
            rating: 'L', //L, 10, 12, 14, 16, 18
            averageAssessment: 4
        );

        $this->assertEquals($uuid, $video->id);
        $this->assertEquals('Spider Man 3', $video->title);
        $this->assertEquals('Desc Spider Man 3', $video->description);
        $this->assertEquals(['genre1', 'genre2'], $video->genres);
        $this->assertEquals(['cast_member1', 'cast_member2'], $video->castMembers);
        $this->assertEquals('L', $video->rating);
        $this->assertEquals(4, $video->averageAssessment);
    }

    public function testUpdateAttributes()
    {
        $video = new Video(
            id: '4343ef84-e046-4a4e-bcd2-a08b9d66fcdd',
            title: 'Spider Man 3',
            description: 'Desc Spider Man 3',
            genres: ['genre1', 'genre2'],
            castMembers: ['cast_member1', 'cast_member2'],
            rating: 'L',
            averageAssessment: 4
        );

        $video->update(
            title: 'Iron Man 3',
            description: 'Desc Iron Man 3',
            genres: ['genre3', 'genre4'],
            castMembers: ['cast_member3', 'cast_member4'],
            rating: '10',
            averageAssessment: 3
        );

        $this->assertEquals('Iron Man 3', $video->title);
        $this->assertEquals('Desc Iron Man 3', $video->description);
        $this->assertEquals(['genre3', 'genre4'], $video->genres);
        $this->assertEquals(['cast_member3', 'cast_member4'], $video->castMembers);
        $this->assertEquals('10', $video->rating);
        $this->assertEquals(3, $video->averageAssessment);
    }

    public function testNotificationException()
    {
        $message = "video: Id is required, ";
        $message .= "video: Title is required, ";
        $message .= "video: Description is required, ";
        $message .= "video: Genres is required, ";
        $message .= "video: CastMembers is required, ";
        $message .= "video: Rating is required";

        try {
            new Video();
            $this->assertTrue(false);
        } catch (\Throwable $th) {
            $this->assertEquals($message, $th->getMessage());
        }
    }
}
