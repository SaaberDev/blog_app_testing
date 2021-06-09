<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateBlogPostRequest;
use App\Http\Requests\PublishBlogPostRequest;
use App\Http\Requests\UpdateBlogPostRequest;
use App\Models\BlogPost;

class BlogPostAdminController
{
    public function index()
    {
        $posts = BlogPost::query()
            ->orderBy('status')
            ->orderByDesc('date')
            ->paginate(100);

        return view('blogAdmin.index', [
            'posts' => $posts,
        ]);
    }

    public function edit(BlogPost $post)
    {
        return view('blogAdmin.edit', [
            'post' => $post,
        ]);
    }

    public function update(
        BlogPost $post,
        UpdateBlogPostRequest $request
    ) {
        $validated = collect($request->validated());

        $post->update($validated->except(['publish', 'body'])->toArray());

        success("Post was saved");

        $body = $validated['body'];

        $post->saveBody($body);

        if ($request->has('publish')) {
            $post->publish();

            success("Post was published");
        }

        return redirect()->action([self::class, 'edit'], $post->slug);
    }

    public function publish(
        BlogPost $post,
        PublishBlogPostRequest $request
    ) {
        if ($request->has('publish')) {
            $post->publish();

            success("Post was published");
        }

        return redirect()->action([self::class, 'index']);
    }

    public function create()
    {
        return view('blogAdmin.create', [
            'post' => new BlogPost([
                'date' => now(),
                'author' => auth()->user()->name,
            ]),
        ]);
    }

    public function store(CreateBlogPostRequest $request)
    {
        $validated = collect($request->validated());

        $post = BlogPost::create($validated->except('body')->toArray());

        $post->saveBody($validated['body']);

        success("Post created");

        return redirect()->action([self::class, 'edit'], $post->slug);
    }
}
