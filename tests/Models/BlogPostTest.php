<?php

namespace Tests\Models;

use App\Models\BlogPost;
use App\Models\Enums\BlogPostStatus;
use Tests\TestCase;

class BlogPostTest extends TestCase
{
    /** @test */
    public function test_published_scope()
    {
        BlogPost::factory()->create([
            'date' => '2021-06-01',
            'status' => BlogPostStatus::PUBLISHED(),
        ]);
    }
}
