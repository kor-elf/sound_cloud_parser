<?php
namespace App\Services\V1;

use Illuminate\Support\Carbon;
use App\Services\BaseService;
use App\Services\ServiceResult;
use App\Models\Artist;
use App\Models\Track;

class UpdaterFromSoundCloudService extends BaseService
{
    private SoundCloudService $soundCloudService;

    public function __construct(SoundCloudService $soundCloudService)
    {
        $this->soundCloudService = $soundCloudService;
    }

    public function updateArtist(string $link): ServiceResult
    {
        $result = $this->soundCloudService->getArtist($link);
        if (!$result->isSuccess()) {
            return $this->errService($result->data['message']);
        }
        $artist = $result->data;

        $artistModel = Artist::updateOrCreate(
            ['service_id' => $artist->getId(), 'service_type' => Artist::SERVICE_SOUNDCLOUD],
            [
                'followers' => $artist->getFollowersCount(),
                'link' => $artist->getLink(),
                'full_name' => $artist->getFullName(),
                'username' => $artist->getUsername(),
                'description' => $artist->getDescription(),
                'city' => $artist->getCity(),
                'country_code' => $artist->getCountryCode()
            ]
        );

        $result = $this->updateTracksForArtist($artistModel);
        if (!$result->isSuccess()) {
            return $this->errService($result->data['message']);
        }

        return $this->ok('The artist has been updated');
    }

    public function updateTracksForArtist(Artist $artist): ServiceResult
    {
        if ($artist->service_type !== Artist::SERVICE_SOUNDCLOUD) {
            return $this->errValidate('Service type !== ' . Artist::SERVICE_SOUNDCLOUD);
        }

        $result = $this->soundCloudService->getTracksFromArtist($artist->service_id);
        if (!$result->isSuccess()) {
            return $this->errService($result->data['message']);
        }
        $tracks = $result->data;

        $currentTracks = $artist->tracks()->whereIn('service_track_id', $tracks->getTracksIds())->get();
        $insertTracks = [];

        foreach ($tracks->getTracks() as $trackId => $track) {
            $update = [
                'title' => $track->getTitle(),
                'duration' => $track->getDuration(),
                'link' => $track->getLink(),
                'description' => $track->getDescription(),
                'license' => $track->getLicense(),
                'comments' => $track->getCommentCount(),
                'likes' => $track->getLikesCount(),
                'playback' => $track->getPlaybackCount(),
                'download' => $track->getDownloadCount()
            ];

            $currentTrack = $currentTracks->where('service_track_id', $trackId)->first();
            if (!is_null($currentTrack)) {
                $currentTrack->update($update);
                continue;
            }

            $now = Carbon::now();
            $update['artist_id'] = $artist->id;
            $update['service_track_id'] = $trackId;
            $update['created_at'] = $now;
            $update['updated_at'] = $now;
            $insertTracks[] = $update;
        }

        if (!empty($insertTracks)) {
            Track::insert($insertTracks);
        }

        return $this->ok('The tracks from artist has been updated');
    }
}
