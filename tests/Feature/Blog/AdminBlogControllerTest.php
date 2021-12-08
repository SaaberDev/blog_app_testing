<?php

namespace Tests\Feature\Blog;

use App\Http\Controllers\BlogPostAdminController;
use App\Models\BlogPost;
use Tests\TestCase;

class AdminBlogControllerTest extends TestCase
{
    /**
     * @test
     */
    public function cannot_post_blog_when_user_is_unauthenticated_and_will_be_redirected_to_login_screen()
    {
        // blog post fake collection
        $post = BlogPost::factory()->make();

        // if unauthenticated redirect to login page
        $this->post(action([BlogPostAdminController::class, 'store']), [
            'title' => $post->title,
            'author' => $post->title,
            'body' => $post->title,
            'date' => $post->date->format('Y-m-d'),
        ])
            ->assertRedirect(route('login'))
        ;
    }

    /**
     * @test
     */
    public function user_can_post_if_authenticated()
    {
        // login
        $this->login();
        $post = BlogPost::factory()->make();

        // post if authenticated and redirect to login page
        $this->post(action([BlogPostAdminController::class, 'store']), [
            'title' => $post->title,
            'author' => $post->title,
            'body' => $post->title,
            'date' => $post->date->format('Y-m-d'),
        ])
            ->assertStatus(302);
    }
}
