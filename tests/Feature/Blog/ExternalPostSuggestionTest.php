<?php

namespace Tests\Feature\Blog;

use App\Http\Controllers\ExternalPostSuggestionController;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Foundation\Testing\WithFaker;
use Tests\TestCase;

class ExternalPostSuggestionTest extends TestCase
{
    /** @test */
    public function external_post_can_be_submitted()
    {
        $this->withoutExceptionHandling();

        $this
            ->post(action(ExternalPostSuggestionController::class))
            ->assertSuccessful()
        ;
    }
}
