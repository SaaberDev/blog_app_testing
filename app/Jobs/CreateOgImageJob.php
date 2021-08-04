<?php

namespace App\Jobs;

use App\Models\BlogPost;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Spatie\Browsershot\Browsershot;

class CreateOgImageJob implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public function __construct(
        private BlogPost $post
    ) {
    }

    public function handle()
    {
        $path = $this->post->ogImagePath();

        $directory = pathinfo($path, PATHINFO_DIRNAME);

        if (! file_exists($directory)) {
            mkdir($directory);
        }

        Browsershot::html(view('blog.ogImage', ['post' => $this->post])->render())
            ->devicePixelRatio(2)
            ->windowSize(1200, 630)
            ->save($this->post->ogImagePath());
    }
}
