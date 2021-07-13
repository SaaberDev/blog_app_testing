<?php

namespace Tests\Policies;

use App\Http\Controllers\BlogPostAdminController;
use App\Http\Controllers\DeletePostController;
use App\Http\Controllers\UpdatePostSlugController;
use App\Models\BlogPost;
use App\Models\User;
use Tests\TestCase;

class BlogPostPolicyTest extends TestCase
{
    /** @test */
    public function only_admin_users_are_allowed()
    {
        [$guest, $admin] = User::factory()
            ->count(2)
            ->sequence(
                ['is_admin' => false],
                ['is_admin' => true],
            )
            ->create();
    }
}
