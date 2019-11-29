<?php

namespace App\Modules\YouTube;

class Video
{
    const YOUTUBE_VIDEO_URL = 'https://www.youtube.com/watch';

    protected $id;
    protected $title;
    protected $url;
    protected $imgUrl;

    public function __construct(string $id, string $title, string $imgUrl)
    {
        $this->id = $id;
        $this->title = $title;
        $this->imgUrl = $imgUrl;
        $this->url = $this->getVideoUrl($id);
    }

    public function getId(): string
    {
        return $this->id;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getUrl(): string
    {
        return $this->url;
    }

    public function getImgUrl(): string
    {
        return $this->imgUrl;
    }

    protected function getVideoUrl(string $id): string
    {
        return sprintf('%s?v=%s', self::YOUTUBE_VIDEO_URL, $id);
    }
}
