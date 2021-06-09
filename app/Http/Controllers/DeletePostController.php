<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePostSlugRequest;
use App\Models\BlogPost;

class DeletePostController
{
    public function __invoke(BlogPost $post, UpdatePostSlugRequest $request)
    {
        dd('hi');
        $post->delete();


        return redirect()->action([UpdatePostSlugController::class, 'index']);
    }
}
