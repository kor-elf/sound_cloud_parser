<?php
namespace App\Parsers\Entity;

class Artist extends AbstractArtist
{
    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function setFollowersCount(int $followersCount): void
    {
        $this->followersCount = $followersCount;
    }

    public function setLink(string $link): void
    {
        $this->link = $link;
    }

    public function setFullName(string $fullName): void
    {
        $this->fullname = $fullName;
    }

    public function setUsername(string $username): void
    {
        $this->username = $username;
    }

    public function setDescription(?string $description): void
    {
        $this->description = $description;
    }

    public function setCity(?string $city): void
    {
        $this->city = $city;
    }

    public function setCountryCode(?string $countryCode): void
    {
        $this->countryCode = $countryCode;
    }
}
