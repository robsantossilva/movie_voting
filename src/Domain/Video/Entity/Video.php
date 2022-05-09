<?php

namespace Core\Domain\Video\Entity;

use Core\Domain\SharedCore\Entity\EntityAbstract;
use Core\Domain\SharedCore\Notification\Notification;
use Core\Domain\SharedCore\Notification\NotificationException;
use Core\Domain\Video\Factory\VideoValidatorFactory;

class Video extends EntityAbstract
{
    public function __construct(
        protected string $id = '',
        protected string $title = '',
        protected string $description = '',
        protected array $genres = [],
        protected array $castMembers = [],
        protected string $rating = '', //L, 10, 12, 14, 16, 18
        protected float $averageAssessment = 0
    ) {
        parent::__construct(new Notification());

        $this->validate();
    }

    public function update(
        string $title = '',
        string $description = '',
        array $genres = [],
        array $castMembers = [],
        string $rating = '',
        float $averageAssessment = 0
    ) {
        $this->title = $title !== '' ? $title : $this->title;
        $this->description = $description !== '' ? $description : $this->description;
        $this->genres = $genres !== [] ? $genres : $this->genres;
        $this->castMembers = $castMembers !== [] ? $castMembers : $this->castMembers;
        $this->rating = $rating !== '' ? $rating : $this->rating;
        $this->averageAssessment = $averageAssessment !== 0 ? $averageAssessment : $this->averageAssessment;

        $this->validate();
    }

    protected function validate()
    {
        VideoValidatorFactory::create()->Validate($this);

        if ($this->notification->hasErrors()) {
            throw new NotificationException($this->notification->getErrors());
        }
    }
}
