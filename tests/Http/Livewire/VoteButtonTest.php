<?php

namespace Tests\Http\Livewire;

use App\Models\BlogPost;
use Ramsey\Uuid\Uuid;
use Tests\TestCase;

class VoteButtonTest extends TestCase
{
    /** @test */
    public function like_can_be_toggled()
    {
        $post = BlogPost::factory()->create([
            'likes' => 10,
        ]);

        $likerUuid = Uuid::uuid4();
    }
}
