<?php
namespace App\Parsers\Entity;

abstract class AbstractArtist
{
    protected int $id;
    protected int $followersCount = 0;
    protected string $link;
    protected string $fullName;
    protected string $username;
    protected ?string $description = null;
    protected ?string $city = null;
    protected ?string $countryCode = null;

    abstract public function setId(int $id);

    abstract public function setFollowersCount(int $followersCount);

    abstract public function setLink(string $link);

    abstract public function setFullName(string $fullName);

    abstract public function setUsername(string $username);

    abstract public function setDescription(?string $description);

    abstract public function setCity(?string $city);

    abstract public function setCountryCode(?string $countryCode);

    public function getId(): int
    {
        return $this->id;
    }

    public function getFollowersCount(): int
    {
        return $this->followersCount;
    }

    public function getLink(): string
    {
        return $this->link;
    }

    public function getFullName(): string
    {
        return $this->fullName;
    }

    public function getUsername(): string
    {
        return $this->username;
    }

    public function getDescription(): ?string
    {
        return $this->description;
    }

    public function getCity(): ?string
    {
        return $this->city;
    }

    public function getCountryCode(): ?string
    {
        return $this->countryCode;
    }
}
