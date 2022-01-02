<?php
namespace App\Parsers\Entity;

class Tracks
{
    private array $tracks = [];

    public function add(AbstractTrack $track): void
    {
        $trackId = $track->getId();
        $this->tracks[$trackId] = $track;
    }

    public function getTracks(): array
    {
        return $this->tracks;
    }

    public function getTracksIds(): array
    {
        return array_keys($this->tracks);
    }
}
