Для работы нужно прописать в файл .env параметр SOUNDCLOUD_CLIENT_ID.
SOUNDCLOUD_CLIENT_ID можно взять c браузера через F12 на сайте https://soundcloud.com/ идём во вкладку "Network" и через фильтр ищем "https://api-v2.soundcloud.com/me?client_id=". Там и находим client_id.

Команда запуска:
php artisan soundcloud-parser:artists --file=/media/projects/web/work/SoundCloudParser/docs/soundcloud-links-artists.txt

Можно так:
php artisan soundcloud-parser:artists --link=https://soundcloud.com/lakeyinspired --link=https://soundcloud.com/aljoshakonstanty

Или так:
php artisan soundcloud-parser:artists --file=/media/projects/web/work/SoundCloudParser/docs/soundcloud-links-artists.txt --link=https://soundcloud.com/lakeyinspired


Если обновлять через сервис, то можно так:
use App\Services\V1\UpdaterFromSoundCloudService;
public function update(UpdaterFromSoundCloudService $updaterFromSoundCloud)
{
    $link = 'https://soundcloud.com/lakeyinspired';
    $result = $updaterFromSoundCloud->updateArtist($link);
    if (!$result->isSuccess()) {
        dd($result->data);
    }
    dd($result->data);
}


Работа самого парсера
use App\Parsers\SoundCloudParser;
class TestController
{
    private SoundCloudParser $soundCloudParser;

    public function __construct(Config $config)
    {
        $timeout = $config::get('soundcloud.timeout');
        $clientId = $config::get('soundcloud.client_id');
        $this->soundCloudParser = new SoundCloudParser($clientId, $timeout);
    }

    public function getArtist()
    {
        $link = 'https://soundcloud.com/lakeyinspired';
        $artist = $this->soundCloudParser->getArtist($link);
        dd($artist);
    }

    public function getTracksFromArtist()
    {
        $artistId = 103470313;
        $limit = 30;
        $tracks = $this->soundCloudParser->getTracksFromArtist($artistId, $limit);
        dd($tracks);
    }
}


