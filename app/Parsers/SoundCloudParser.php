<?php
namespace App\Parsers;

use Illuminate\Support\Facades\Http;
use App\Parsers\Entity\AbstractArtist;
use App\Parsers\Entity\Artist;
use App\Parsers\Entity\Track;

class SoundCloudParser
{
    const API_LINK = 'https://api-v2.soundcloud.com';

    private string $clientId;
    private int    $timeout;

    public function __construct(string $clientId, int $timeout = 60)
    {
        $this->clientId = $clientId;
        $this->timeout = $timeout;
    }

    public function getArtist(string $link): AbstractArtist
    {
        $url = self::API_LINK . '/resolve?url=' . $link . '&client_id=' . $this->clientId;
        $response = Http::timeout($this->timeout)->get($url)->throw()->json();

        $artist = new Artist();
        $id = $response['id'];
        $artist->setId($id);
        $followersCount = $response['followers_count'];
        $artist->setFollowersCount($followersCount);
        $link = $response['permalink_url'];
        $artist->setLink($link);
        $fullName = $response['full_name'];
        $artist->setFullName($fullName);
        $username = $response['username'];
        $artist->setUsername($username);
        $description = \nl2br($response['description']);
        $artist->setDescription($description);
        $city = $response['city'];
        $artist->setCity($city);
        $countryCode = $response['country_code'];
        $artist->setCountryCode($countryCode);

        return $artist;
    }

    /**
     * return array Track
     */
    public function getTracksFromArtist(int $artistId, int $limit = 30): array
    {
        $url = self::API_LINK . '/users/' . $artistId . '/tracks?access=playable%2Cpreview&limit=' . $limit . '&client_id=' . $this->clientId;
        $response = Http::timeout($this->timeout)->get($url)->throw()->json();

        $tracks = [];

        foreach ($response['collection'] as $soundCloudTrack) {

            $track = new Track();
            $id = $soundCloudTrack['id'];
            $track->setId($id);
            $duration = $soundCloudTrack['duration'];
            $track->setDuration($duration);
            $commentCount = $soundCloudTrack['comment_count'];
            $track->setCommentCount($commentCount);
            $likesCount = $soundCloudTrack['likes_count'];
            $track->setLikesCount($likesCount);
            $playbackCount = $soundCloudTrack['playback_count'];
            $track->setPlaybackCount($playbackCount);
            $downloadCount = $soundCloudTrack['download_count'];
            $track->setDownloadCount($downloadCount);
            $title = $soundCloudTrack['title'];
            $track->setTitle($title);
            $link = $soundCloudTrack['permalink_url'];
            $track->setLink($link);
            $description = $soundCloudTrack['description'];
            $track->setDescription($description);
            $license = $soundCloudTrack['license'];
            $track->setLicense($license);

            $tracks[] = $track;
            unset($track);
        }

        return $tracks;
    }

}
