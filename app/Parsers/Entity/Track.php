<?php
namespace App\Parsers\Entity;

class Track extends AbstractTrack
{
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setDuration(int $duration): void
    {
        $this->duration = $duration;
    }

    public function setCommentCount(int $commentCount): void
    {
        $this->commentCount = $commentCount;
    }

    public function setLikesCount(int $likesCount): void
    {
        $this->likesCount = $likesCount;
    }

    public function setPlaybackCount(int $playbackCount): void
    {
        $this->playbackCount = $playbackCount;
    }

    public function setDownloadCount(int $downloadCount): void
    {
        $this->downloadCount = $downloadCount;
    }

    public function setTitle(string $title): void
    {
        $this->title = $title;
    }

    public function setLink(string $link): void
    {
        $this->link = $link;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function setLicense(?string $license): void
    {
        $this->license = $license;
    }
}
