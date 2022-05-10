<?php

namespace Tests\Unit\Domain\Video\ValueObject;

use Core\Domain\Video\ValueObject\CastMember;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\Uuid;

class CastMemberUnitTest extends TestCase
{
    public function testCastMemberAttributes()
    {

        $uuid = Uuid::v4();

        $catMember = new CastMember(
            id: $uuid,
            name: 'Robert Downey Jr',
            description: 'Desc Robert Downey Jr'
        );

        $this->assertEquals($uuid, $catMember->id);
        $this->assertEquals('Robert Downey Jr', $catMember->name);
        $this->assertEquals('Desc Robert Downey Jr', $catMember->description);
        $this->assertTrue(Uuid::isValid($catMember->id));
    }

    public function testUpdateAttributes()
    {
        $uuid = Uuid::v4();
        $catMember = new CastMember(
            id: $uuid,
            name: 'Robert Downey Jr',
            description: 'Desc Robert Downey Jr'
        );

        $catMember->update(
            name: 'Chris Evans',
            description: 'Desc Chris Evans',
        );

        $this->assertEquals($uuid, $catMember->id);
        $this->assertEquals('Chris Evans', $catMember->name);
        $this->assertEquals('Desc Chris Evans', $catMember->description);
        $this->assertTrue(Uuid::isValid($catMember->id));
    }

    public function testNotificationException()
    {
        $message = "cast_member: Id is required, ";
        $message .= "cast_member: Name is required, ";
        $message .= "cast_member: Description is required";

        try {
            new CastMember();
            $this->assertTrue(false);
        } catch (\Throwable $th) {
            $this->assertEquals($message, $th->getMessage());
        }
    }
}
