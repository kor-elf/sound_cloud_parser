<?php
namespace App\Parsers\Entity;

abstract class AbstractTrack
{
    protected int $id;
    protected int $duration;
    protected int $commentCount = 0;
    protected int $likesCount = 0;
    protected int $playbackCount = 0;
    protected int $downloadCount = 0;
    protected string $title;
    protected string $link;
    protected ?string $description;
    protected ?string $license;

    abstract public function setId(int $id);

    abstract public function setDuration(int $duration);

    abstract public function setCommentCount(int $commentCount);

    abstract public function setLikesCount(int $likesCount);

    abstract public function setPlaybackCount(int $playbackCount);

    abstract public function setDownloadCount(int $downloadCount);

    abstract public function setTitle(string $title);

    abstract public function setLink(string $link);

    abstract public function setDescription(?string $description);

    abstract public function setLicense(?string $license);

    public function getId(): int
    {
        return $this->id;
    }

    public function getDuration(): int
    {
        return $this->duration;
    }

    public function getCommentCount(): int
    {
        return $this->commentCount;
    }

    public function getLikesCount(): int
    {
        return $this->likesCount;
    }

    public function getPlaybackCount(): int
    {
        return $this->playbackCount;
    }

    public function getDownloadCount(): int
    {
        return $this->downloadCount;
    }

    public function getTitle(): string
    {
        return $this->title;
    }

    public function getLink(): string
    {
        return $this->link;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getLicense(): ?string
    {
        return $this->license;
    }
}
