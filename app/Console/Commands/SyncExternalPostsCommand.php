<?php

namespace App\Console\Commands;

use App\Models\Enums\ExternalPostStatus;
use App\Models\ExternalPost;
use App\Support\Rss\RssEntry;
use App\Support\Rss\RssRepository;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Spatie\Fork\Fork;

class SyncExternalPostsCommand extends Command
{
    protected $signature = 'sync:externals';

    protected $description = 'Sync external RSS feeds';

    public function handle(RssRepository $rss)
    {
        $feeds = config('services.external_feeds');

        $this->info('Fetching ' . count($feeds) . ' feeds');

        Fork::new()
            ->before(child: fn () => DB::connection('mysql')->reconnect())
            ->concurrent(10)
            ->run(...array_map(function (string $url) use ($rss) {
                return function () use ($rss, $url) {
                    $this->comment("\t- $url");

                    $entries = $rss->fetch($url)
                        ->sortBy(fn (RssEntry $rss) => $rss->date->getTimestamp());

                    foreach ($entries as $entry) {
                        ExternalPost::updateOrCreate([
                            'url' => $entry->url,
                        ], [
                            'title' => $entry->title,
                            'date' => $entry->date,
                            'domain' => $entry->getDomain(),
                            'status' => ExternalPostStatus::ACTIVE(),
                        ]);
                    }
                };
            }, $feeds));

        $this->info('Done');
    }

}
