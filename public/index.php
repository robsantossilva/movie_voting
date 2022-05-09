<?php

require_once '../vendor/autoload.php';

use Core\Domain\Video\Video;

$video = new Video();
var_dump($video->title);
