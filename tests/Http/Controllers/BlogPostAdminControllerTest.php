<?php

namespace Tests\Http\Controllers;

use App\Http\Controllers\BlogPostAdminController;
use App\Http\Controllers\UpdatePostSlugController;
use App\Models\BlogPost;
use App\Models\Redirect;
use Tests\TestCase;

class BlogPostAdminControllerTest extends TestCase
{
    private BlogPost $blogPost;

    protected function setUp(): void
    {
        parent::setUp();

        $this->blogPost = BlogPost::factory()->create();
    }

    /** @test */
    public function only_a_logged_in_user_can_make_changes_to_a_post()
    {
        $sendRequest = fn () => $this->post(action([BlogPostAdminController::class, 'update'], $this->blogPost->slug), [
            'title' => 'test',
            'author' => $this->blogPost->author,
            'body' => $this->blogPost->body,
            'date' => $this->blogPost->date->format('Y-m-d'),
        ]);

        $sendRequest()->assertRedirect(route('login'));

        $this->assertNotEquals('test', $this->blogPost->refresh()->title);

        $this->login();

        $sendRequest();

        $this->assertEquals('test', $this->blogPost->refresh()->title);
    }

    /** @test */
    public function required_fields_are_validated()
    {
        $this->login();

        $this
            ->post(action([BlogPostAdminController::class, 'update'], $this->blogPost->slug), [])
            ->assertSessionHasErrors(['title', 'author', 'body', 'date']);

        $this
            ->post(action([BlogPostAdminController::class, 'update'], $this->blogPost->slug), [
                'title' => $this->blogPost->title,
                'author' => $this->blogPost->author,
                'body' => $this->blogPost->body,
                'date' => $this->blogPost->date->format('Y-m-d'),
            ])
            ->assertSessionHasNoErrors();
    }

    /** @test */
    public function date_format_is_validated()
    {
        $this->login();

        $this
            ->post(action([BlogPostAdminController::class, 'update'], $this->blogPost->slug), [
                'title' => $this->blogPost->title,
                'author' => $this->blogPost->author,
                'body' => $this->blogPost->body,
                'date' => '01/01/2021',
            ])
            ->assertSessionHasErrors([
                'date' => 'The date does not match the format Y-m-d.'
            ])
        ;
    }

    /** @test */
    public function slug_update_creates_redirect()
    {
        $this->login();

        $post = BlogPost::factory()->create([
            'slug' => 'slug-a',
        ]);

        $this->withoutExceptionHandling();

        $this
            ->post(action(UpdatePostSlugController::class, [$post->slug]), [
                'slug' => 'slug-b',
            ])
            ->assertSuccessful();

        $this->assertDatabaseHas(Redirect::class, [
            'from' => '/blog/slug-a',
            'to' => '/blog/slug-b',
        ]);

        $this->assertEquals('slug-b', $post->refresh()->slug);
    }
}
