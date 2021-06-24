<?php

namespace App\Console\Commands;

use App\Actions\SyncExternalPost;
use Illuminate\Console\Command;

class SyncExternalPostsCommand extends Command
{
    protected $signature = 'sync:externals';

    protected $description = 'Sync external RSS feeds';

    public function handle(SyncExternalPost $sync)
    {
        $feeds = config('services.external_feeds');

        $this->info('Fetching ' . count($feeds) . ' feeds');

        foreach ($feeds as $url) {
            $sync($url);
        }

        $this->info('Done');
    }

}
