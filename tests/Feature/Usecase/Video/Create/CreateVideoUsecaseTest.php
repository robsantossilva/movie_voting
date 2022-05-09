<?php

namespace Tests\Feature\Usecase\Video\Create;

use App\Models\CastMember;
use App\Models\Genre;
use App\Models\Video;
use Core\Domain\Video\Repository\VideoRepositoryInterface;
use Core\Infraestructure\Video\Repository\Eloquent\VideoRepository;
use Core\Usecase\Video\Create\CreateVideoUsecase;
use Core\Usecase\Video\Create\InputCreateVideoDto;
use Core\Usecase\Video\Create\OutputCreateVideoDto;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class CreateVideoUsecaseTest extends TestCase
{
    use DatabaseMigrations;

    public function testCreateVideo()
    {
        $genresExpected = $this->buildGenres();
        $castMembersExpected = $this->buildCastMembers();

        $videoRepository = new VideoRepository();

        /**
         * @var VideoRepositoryInterface $videoRepository
         */
        $createVideoUseCase = new CreateVideoUsecase($videoRepository);

        $input = new InputCreateVideoDto(
            title: 'Spider Man 3',
            description: 'Desc Spider Man 3',
            genres: $genresExpected,
            castMembers: $castMembersExpected,
            rating: 'L', //L, 10, 12, 14, 16, 18
            averageAssessment: 4
        );

        $output = $createVideoUseCase->execute($input);

        $this->assertInstanceOf(OutputCreateVideoDto::class, $output);
        $this->assertNotEmpty($output->id);
        $this->assertTrue(Uuid::isValid($output->id));
        $this->assertEquals('Spider Man 3', $output->title);
        $this->assertEquals('Desc Spider Man 3', $output->description);
        $this->assertEquals($genresExpected, $output->genres);
        $this->assertEquals($castMembersExpected, $output->castMembers);
        $this->assertEquals('L', $output->rating);
        $this->assertEquals(4, $output->averageAssessment);

        $videoInDb = $videoRepository->find($output->id);
        $this->assertNotEmpty($videoInDb->id);
        $this->assertEquals('Spider Man 3', $videoInDb->title);
        $this->assertEquals('Desc Spider Man 3', $videoInDb->description);
        $this->assertEquals($genresExpected, $videoInDb->genres);
        $this->assertEquals($castMembersExpected, $output->castMembers);
        $this->assertEquals('L', $videoInDb->rating);
        $this->assertEquals(4, $videoInDb->averageAssessment);
    }

    public function buildGenres(): array
    {

        $genre1 = Genre::create([
            'id' => Uuid::uuid4()->toString(),
            'name' => 'Chris Evans',
            'description' => 'Desc Chris Evans'
        ]);

        $genre2 = Genre::create([
            'id' => Uuid::uuid4()->toString(),
            'name' => 'Robert Downey Jr',
            'description' => 'Desc Robert Downey Jr'
        ]);

        return [$genre1->id, $genre2->id];
    }

    public function buildCastMembers(): array
    {

        $cm1 = CastMember::create([
            'id' => Uuid::uuid4()->toString(),
            'name' => 'Ação',
            'description' => 'Desc Ação'
        ]);

        $cm2 = CastMember::create([
            'id' => Uuid::uuid4()->toString(),
            'name' => 'Comédia',
            'description' => 'Desc Comédia'
        ]);

        return [$cm1->id, $cm2->id];
    }
}
