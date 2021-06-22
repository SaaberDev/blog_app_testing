<?php

namespace Tests\Feature\Blog;

use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\ExternalPostSuggestionController;
use App\Models\ExternalPost;
use App\Models\User;
use Tests\TestCase;

class ExternalPostSuggestionTest extends TestCase
{
    /** @test */
    public function external_post_can_be_submitted()
    {
        $this->withoutExceptionHandling();

        User::factory()->create();

        $this
            ->post(action(ExternalPostSuggestionController::class), [
                'title' => 'test',
                'url' => 'https://spatie.be',
            ])
            ->assertRedirect(action([BlogPostController::class, 'index']))
            ->assertSessionHas('laravel_flash_message')
        ;

        $this->assertDatabaseHas(ExternalPost::class, [
            'title' => 'test',
            'url' => 'https://spatie.be',
        ]);
    }
}
