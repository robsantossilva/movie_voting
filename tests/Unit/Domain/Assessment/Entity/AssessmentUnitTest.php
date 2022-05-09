<?php

namespace Tests\Unit\Domain\Assessment\Entity;

use Core\Domain\Assessment\Entity\Assessment;
use PHPUnit\Framework\TestCase;

class AssessmentUnitTest extends TestCase
{
    public function testAttributes()
    {

        $votesPerGrade =  [
            1 => 34,
            2 => 63,
            3 => 41,
            4 => 31,
            5 => 52,
        ];

        $averageGrade = (5 * 52 + 4 * 31 + 3 * 41 + 2 * 63 + 1 * 34) / (52 + 31 + 41 + 63 + 34);
        $averageGrade = number_format($averageGrade, 1);

        $assessment = new Assessment(
            videoId: "123",
            votesPerGrade: $votesPerGrade
        );

        $this->assertEquals("123", $assessment->videoId);
        $this->assertEquals($votesPerGrade, $assessment->votesPerGrade);
        $this->assertEquals($averageGrade, $assessment->averageGrade);
    }

    public function testEmptyAverageGrade()
    {
        $votesPerGrade =  [
            1 => 0,
            2 => 0,
            3 => 0,
            4 => 0,
            5 => 0,
        ];

        $averageGrade = 0;

        $assessment = new Assessment(
            videoId: "123",
            votesPerGrade: $votesPerGrade
        );

        $this->assertEquals($averageGrade, $assessment->averageGrade);

        $votesPerGrade =  [
            1 => 2,
            2 => 3,
        ];

        $averageGrade = 1.6;

        $assessment = new Assessment(
            videoId: "123",
            votesPerGrade: $votesPerGrade
        );

        $this->assertEquals($averageGrade, $assessment->averageGrade);
    }

    public function testNotificationException()
    {
        $message = "assessment: VideoId is required, ";
        $message .= "assessment: VotesPerGrade is required";

        try {
            new Assessment();
            $this->assertTrue(false);
        } catch (\Throwable $th) {
            $this->assertEquals($message, $th->getMessage());
        }
    }
}
