<?php
namespace App\Services\V1;

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Validator;
use App\Services\BaseService;
use App\Services\ServiceResult;
use App\Parsers\SoundCloudParser;

class SoundCloudService extends BaseService
{
    private SoundCloudParser $soundCloudParser;

    public function __construct(Config $config)
    {
        $timeout = $config::get('soundcloud.timeout');
        $clientId = $config::get('soundcloud.client_id');
        $this->soundCloudParser = new SoundCloudParser($clientId, $timeout);
    }

    public function getArtist(string $link): ServiceResult
    {
        $params = [
            'link' => $link
        ];
        $validator = Validator::make($params, [
            'link' => 'regex:/^https:\/\/soundcloud.com\/([\w\-]+)$/i',
        ]);

        if ($validator->fails()) {
            return $this->errValidate('The link format is invalid.');
        }

        try {
            $artist = $this->soundCloudParser->getArtist($link);
        } catch (\Throwable $th) {
            return $this->errService('Error get the artist');
        }

        return $this->result($artist);
    }

    public function getTracksFromArtist(int $artistId, int $limit = 30): ServiceResult
    {
        try {
            $tracks = $this->soundCloudParser->getTracksFromArtist($artistId, $limit);
        } catch (\Throwable $th) {
            return $this->errService('Error get the tracks');
        }

        return $this->result($tracks);
    }
}
