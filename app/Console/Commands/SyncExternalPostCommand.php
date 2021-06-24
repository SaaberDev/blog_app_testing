<?php

namespace App\Console\Commands;

use App\Actions\SyncExternalPost;
use App\Models\Enums\ExternalPostStatus;
use App\Models\ExternalPost;
use App\Support\Rss\RssEntry;
use App\Support\Rss\RssRepository;
use Illuminate\Console\Command;

class SyncExternalPostCommand extends Command
{
    protected $signature = 'sync:external {url}';

    protected $description = 'Sync external RSS feed';

    public function handle(SyncExternalPost $sync)
    {
        $url = $this->argument('url');

        $this->comment("Syncing $url");

        $sync($url);

        $this->info('Done');
    }

}
