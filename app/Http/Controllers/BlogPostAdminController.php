<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdatePostRequest;
use App\Models\BlogPost;

class BlogPostAdminController
{
    public function index()
    {
        $posts = BlogPost::query()->orderByDesc('date')->paginate(100);

        return view('blogAdmin.index', [
            'posts' => $posts,
        ]);
    }

    public function edit(BlogPost $post)
    {
        return view('blogAdmin.form', [
            'post' => $post,
        ]);
    }

    public function update(
        BlogPost $post,
        UpdatePostRequest $request
    ) {
        $validated = $request->validated();

        $post->update($validated);

        return redirect()->action([self::class, 'edit'], $post->slug);
    }

    public function create()
    {

    }

    public function store()
    {

    }
}
