<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Validator;
use App\Services\V1\UpdaterFromSoundCloudService;

class SoundCloudParserArtistsCommand extends Command
{
    private UpdaterFromSoundCloudService $updaterFromSoundCloud;

    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'soundcloud-parser:artists {--link=* : Link to artist SoundClound} {--file= : Absolute path to the file with list of artist links}';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'command for parser artists SoundCloud';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct(UpdaterFromSoundCloudService $updaterFromSoundCloud)
    {
        $this->updaterFromSoundCloud = $updaterFromSoundCloud;

        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        $links = $this->option('link');
        $pathFile = $this->option('file');

        if (!empty($links)) {
            $this->parserLinks($links);
        }

        if (!is_null($pathFile)) {
            $this->parserFile($pathFile);
        }

        // dd($this->soundCloudParser->getArtist());

        /*
        $this->line('Собираем данные от раздела "Подкаст"');
        $this->info('Данные от раздела "Подкаст" получили');
        */


        // return 0;
    }

    private function parserLink(string $link): bool
    {
        $link = \rtrim($link, '/');
        $this->line('Started: ' . $link);

        $isValidate = $this->isValidateLink($link);

        if (!$isValidate) {
            $this->error('Error: ' . $link);
            return false;
        }

        $result = $this->updaterFromSoundCloud->updateArtist($link);
        if (!$result->isSuccess()) {
            $this->error('Error: ' . $result->data['message']);
            return false;
        }

        $this->info('Success: ' . $link);
        return true;
    }

    private function parserLinks(array $links): void
    {
        foreach ($links as $linkKey => $link) {
            $this->parserLink($link);
        }
    }

    private function parserFile(string $pathFile): void
    {
        try {
            $fp = fopen($pathFile, 'r');
            while ($line = fgets($fp, 4096)) {
                $link = trim($line);

                if (empty($link)) {
                    continue;
                }

                $this->parserLink($link);
            }
            fclose($fp);
        } catch (\ErrorException $error) {
            $this->error('Error: couldn\'t read the file');
        }
    }

    private function isValidateLink(string $link): bool
    {
        $params = [
            'link' => $link
        ];
        $validator = Validator::make($params, [
            'link' => 'required|url',
        ]);

        if ($validator->fails()) {
            foreach ($validator->errors()->all() as $error) {
                $this->error($error);
            }
            return false;
        }

        return true;
    }
}
