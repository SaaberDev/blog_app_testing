<?php

namespace Tests\Feature\Blog;

use App\Http\Controllers\ExternalPostSuggestionController;
use App\Mail\ExternalPostSuggestedMail;
use App\Models\BlogPost;
use App\Models\ExternalPost;
use App\Models\User;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExternalPostSuggestionTest extends TestCase
{
    public $data = [
        'title' => 'Splitting a large Laravel Livewire Component',
        'url' => 'https://dev.to/chrisrhymes/splitting-a-large-laravel-livewire-component-569l',
    ];

    /** @test */
    public function external_post_can_be_submitted()
    {
        $this->withoutExceptionHandling();

        User::factory()->create();

        // submit blog
        $this->post(action(ExternalPostSuggestionController::class), $this->data)
            // redirect after post
            ->assertRedirect(route('guest.blog.index'))
            // alert
            ->assertSessionHas('laravel_flash_message')
        ;

        // send mail
        $mailable = new ExternalPostSuggestedMail($this->data['title'], $this->data['url']);
        $mailable->assertSeeInHtml('Splitting a large Laravel Livewire Component');

        // database post test
        $this->assertDatabaseHas(ExternalPost::class, [
            'title' => 'Splitting a large Laravel Livewire Component',
            'url' => 'https://dev.to/chrisrhymes/splitting-a-large-laravel-livewire-component-569l',
        ]);
    }
}
