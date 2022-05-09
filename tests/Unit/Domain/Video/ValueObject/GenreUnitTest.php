<?php

namespace Tests\Unit\Domain\Video\Entity;

use Core\Domain\Video\ValueObject\Genre;
use PHPUnit\Framework\TestCase;
use Symfony\Component\Uid\Uuid;

class GenreUnitTest extends TestCase
{
    public function testGenreAttributes()
    {

        $uuid = Uuid::v4();

        $genre = new Genre(
            id: $uuid,
            name: 'Ação',
            description: 'Desc Ação'
        );

        $this->assertEquals($uuid, $genre->id);
        $this->assertEquals('Ação', $genre->name);
        $this->assertEquals('Desc Ação', $genre->description);
        $this->assertTrue(Uuid::isValid($genre->id));
    }

    public function testUpdateAttributes()
    {
        $uuid = Uuid::v4();
        $genre = new Genre(
            id: $uuid,
            name: 'Ação',
            description: 'Desc Ação'
        );

        $genre->update(
            name: 'Comédia',
            description: 'Desc Comédia',
        );

        $this->assertEquals($uuid, $genre->id);
        $this->assertEquals('Comédia', $genre->name);
        $this->assertEquals('Desc Comédia', $genre->description);
        $this->assertTrue(Uuid::isValid($genre->id));
    }

    public function testNotificationException()
    {
        $message = "genre: Id is required, ";
        $message .= "genre: Name is required, ";
        $message .= "genre: Description is required";

        try {
            new Genre();
            $this->assertTrue(false);
        } catch (\Throwable $th) {
            $this->assertEquals($message, $th->getMessage());
        }
    }
}
