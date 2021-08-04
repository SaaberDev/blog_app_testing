<?php

namespace Tests\Jobs;

use App\Jobs\CreateOgImageJob;
use App\Models\BlogPost;
use Illuminate\Bus\Dispatcher;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Storage;
use Tests\TestCase;

class CreateOgImageJobTest extends TestCase
{
    /** @test */
    public function job_is_dispatched_correctly()
    {
        Bus::fake();
        $post = BlogPost::factory()->create();
        Bus::assertDispatched(CreateOgImageJob::class);

        Bus::fake();
        $post->refresh()->save();
        Bus::assertDispatched(CreateOgImageJob::class);

        Bus::fake();
        $post->update([
            'title' => 'Other Title',
        ]);
        Bus::assertDispatched(CreateOgImageJob::class);
    }

    /** @test */
    public function file_is_generated_correctly()
    {
        Bus::swap(app(Dispatcher::class));

        Storage::fake('public');

        $post = BlogPost::factory()->create();

        Storage::disk('public')->assertExists("blog/{$post->slug}.png");
    }
}
