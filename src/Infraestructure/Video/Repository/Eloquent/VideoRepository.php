<?php

namespace Core\Infraestructure\Video\Repository\Eloquent;

use App\Models\Video as ModelsVideo;
use Core\Domain\SharedCore\Entity\EntityAbstract;
use Core\Domain\Video\Entity\Video;
use Core\Domain\Video\Repository\VideoRepositoryInterface;

use Illuminate\Database\Eloquent\Collection;

class VideoRepository implements VideoRepositoryInterface
{
    public function create(EntityAbstract $entity): void
    {

        /**
         * @var Video $entity
         * @var ModelsVideo $video
         */
        $video = ModelsVideo::create([
            'id' => $entity->id,
            'title' => $entity->title,
            'description' => $entity->description,
            'rating' => $entity->rating,
            'averageAssessment' => $entity->averageAssessment
        ]);

        //var_dump($entity);

        //var_dump($video->id);

        $video->genres()->sync($entity->genres);
        $video->castMembers()->sync($entity->castMembers);
    }

    public function update(EntityAbstract $entity): void
    {
    }

    public function find(string $id): Video
    {

        /**
         * @var Illuminate\Database\Eloquent\Collection $video
         */
        $video = ModelsVideo::find($id);

        return new Video(
            id: $video->id,
            title: $video->title,
            description: $video->description,
            rating: $video->rating, //L, 10, 12, 14, 16, 18
            averageAssessment: $video->averageAssessment,

            genres: array_map(function ($g) {
                return $g['id'];
            }, $video->genres->toArray()),

            castMembers: array_map(function ($c) {
                return $c['id'];
            }, $video->castMembers->toArray())
        );
    }

    public function findAll(): array
    {
        return [];
    }
}
