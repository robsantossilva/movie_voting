<?php

namespace Tests\Unit\Domain\Assessment\Entity;

use Core\Domain\Assessment\Entity\Vote;
use PHPUnit\Framework\TestCase;

class VoteUnitTest extends TestCase
{
    public function testAttributes()
    {
        $timestamp = date("Y-m-d H:i:s");

        $vote = new Vote(
            videoId: "video_123",
            userId: "user_123",
            grade: 3,
            date: $timestamp
        );

        $this->assertEquals("video_123", $vote->videoId);
        $this->assertEquals("user_123", $vote->userId);
        $this->assertEquals(3, $vote->grade);
        $this->assertEquals($timestamp, $vote->date);
    }

    public function testNotificationException()
    {
        $timestamp = date("Y-m-d H:i:s");

        $message = "vote: VideoId is required, ";
        $message .= "vote: UserId is required, ";
        $message .= "vote: Grade is required, ";
        $message .= "vote: Date is required";

        try {
            new Vote();
            $this->assertTrue(false);
        } catch (\Throwable $th) {
            $this->assertEquals($message, $th->getMessage());
        }

        $message = "vote: VideoId is required, ";
        $message .= "vote: UserId is required, ";
        $message .= "vote: Grade is required";

        try {
            new Vote(
                // videoId: "video_123",
                // userId: "user_123",
                // grade: 3,
                date: $timestamp
            );
            $this->assertTrue(false);
        } catch (\Throwable $th) {
            $this->assertEquals($message, $th->getMessage());
        }

        $message = "vote: VideoId is required, ";
        $message .= "vote: UserId is required";

        try {
            new Vote(
                // videoId: "video_123",
                // userId: "user_123",
                grade: 0,
                date: $timestamp
            );
            $this->assertTrue(false);
        } catch (\Throwable $th) {
            $this->assertEquals($message, $th->getMessage());
        }
    }
}
