<?php

namespace Tests\Feature\Blog;

use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class BlogIndexTest extends TestCase
{
    /** @test */
    public function index_shows_a_list_of_blog_posts()
    {
        $this->get('/')
            ->assertStatus(200)
            ->assertSee('Articles on PHP')
        ;
    }
}
