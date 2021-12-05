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
    public function cannot_post_blog_when_user_is_unauthenticated()
    {
        $this->withoutExceptionHandling();

        // blog post fake collection
        $blog = $this->blogData();

        // if unauthenticated redirect to login page
        $this->post(action([BlogPostAdminController::class, 'store']), $blog)
            ->assertRedirect(route('login'))
        ;

        // login
//        $this->login();
//
//        // post if authenticated and redirect to login page
//        $this->post(action([BlogPostAdminController::class, 'store']), $blog);
//
//        // test database
//        $this->assertDatabaseHas(BlogPost::class, $blog);
    }

    /**
     * @return array
     */
    private function blogData(): array
    {
        return BlogPost::factory()
            ->published()
            ->sequence(['title' => 'New Published Post', 'date' => '2021-03-20'])
            ->make()
            ->toArray();
    }
}
