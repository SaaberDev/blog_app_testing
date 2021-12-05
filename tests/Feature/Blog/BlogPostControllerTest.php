<?php

namespace Tests\Feature\Blog;

use App\Models\BlogPost;
use Tests\TestCase;

class BlogPostControllerTest extends TestCase
{
    /** @test */
    public function index_shows_a_list_of_blog_posts()
    {
        $this->withoutExceptionHandling();

        // published post
        BlogPost::factory()
            ->count(3)
            ->published()
            ->sequence(
                ['title' => 'Parallel php', 'date' => '2021-06-01'],
                ['title' => 'What event sourcing is not about', 'date' => '2021-05-01'],
                ['title' => 'Jit setup', 'date' => '2021-04-01'],
            )
            ->create()
        ;

        // draft post
        BlogPost::factory()
            ->draft()
            ->create(
                ['title' => 'Draft', 'date' => '2021-04-01']
            );

        $this->get('/')
            ->assertStatus(200)
            ->assertSuccessful()
            ->assertSee('Parallel php')
            ->assertDontSee('Draft')
            ->assertSeeInOrder(
                [
                    'Parallel php',
                    'What event sourcing is not about',
                    'Jit setup',
                ]
            )
        ;
    }
}
