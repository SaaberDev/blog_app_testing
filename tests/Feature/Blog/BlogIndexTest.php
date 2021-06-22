<?php

namespace Tests\Feature\Blog;

use App\Models\BlogPost;
use App\Models\Enums\BlogPostStatus;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Tests\TestCase;

class BlogIndexTest extends TestCase
{
    use RefreshDatabase;

    /** @test */
    public function index_shows_a_list_of_blog_posts()
    {
        $this->withoutExceptionHandling();

        BlogPost::create([
            'title' => 'Parallel php',
            'date' => '2021-01-01',
            'body' => 'test',
            'author' => 'Brent',
            'status' => BlogPostStatus::PUBLISHED(),
        ]);

        BlogPost::create([
            'title' => 'Fibers',
            'date' => '2021-01-01',
            'body' => 'test',
            'author' => 'Brent',
            'status' => BlogPostStatus::PUBLISHED(),
        ]);

        BlogPost::create([
            'title' => 'Thoughts on event sourcing',
            'date' => '2021-02-01',
            'body' => 'test',
            'author' => 'Brent',
            'status' => BlogPostStatus::PUBLISHED(),
        ]);

        BlogPost::create([
            'title' => 'Draft post',
            'date' => '2021-02-01',
            'body' => 'test',
            'author' => 'Brent',
            'status' => BlogPostStatus::DRAFT(),
        ]);

        $this
            ->get('/')
            ->assertSuccessful()
            ->assertSee('Parallel php')
            ->assertSeeInOrder([
                'Thoughts on event sourcing',
                'Fibers',
            ])
            ->assertDontSee('Draft post')
        ;
    }
}
