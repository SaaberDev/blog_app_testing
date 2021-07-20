<?php

namespace Tests\View\Components;

use App\Models\BlogPost;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Tests\TestCase;

class LastSeenTest extends TestCase
{
    /** @test */
    public function test_last_seen()
    {
        $post = BlogPost::factory()->create();

        $this->travelTo(Carbon::make('2021-01-01'));

        $this->blade('<x-last-seen :post="$post" />', ['post' => $post])
            ->assertDontSee('Last seen')
            ->assertDontSee('2021-01-01');

        app(Request::class)->cookies->set("last_seen_{$post->slug}", now()->toDateTimeString());

        $this->blade('<x-last-seen :post="$post" />', ['post' => $post])
            ->assertSee('Last seen')
            ->assertSee('2021-01-01');
    }
}
