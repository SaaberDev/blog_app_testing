<?php

namespace App\Http\Controllers;

use App\Models\BlogPost;

class BlogPostOgImageController
{
    public function __invoke(BlogPost $post)
    {
        if (file_exists($post->ogImagePath())) {
            return response()->file($post->ogImagePath());
        }

        return view('blog.ogImage', ['post' => $post]);
    }
}
