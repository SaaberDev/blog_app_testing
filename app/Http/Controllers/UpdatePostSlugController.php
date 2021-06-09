<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePostSlugRequest;
use App\Models\BlogPost;
use App\Models\Redirect;

class UpdatePostSlugController
{
    public function __invoke(BlogPost $post, UpdatePostSlugRequest $request)
    {
        $validated = $request->validated();

        $oldSlug = $post->slug;

        $newSlug = $validated['slug'];

        Redirect::createForPost($oldSlug, $newSlug);

        $post->update($validated);

        return redirect()->action([BlogPostAdminController::class, 'edit'], $post->slug);
    }
}
