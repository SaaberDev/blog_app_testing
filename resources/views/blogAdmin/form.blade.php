<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Edit {{ $post->title }}
            </h2>

            <a href="{{ action([\App\Http\Controllers\BlogPostController::class, 'show'], $post->slug) }}"
               class="bg-blue-400 px-4 py-2 text-white font-bold hover:bg-blue-700 shadow rounded text-sm"
               target="_blank" rel="noopener noreferrer"
            >
                Show
            </a>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <form
            action="{{ action([\App\Http\Controllers\BlogPostAdminController::class, 'update'], $post->slug) }}"
            method="post"
        >
            <div class="grid grid-cols-4 gap-4 gap-x-8">
                @csrf()

                <div class="grid grid-cols-4 col-span-4 gap-x-8 bg-white shadow rounded p-8">
                    <div class="col-span-2 flex">
                        <label class="font-bold mr-2 py-2" for="title">Title</label>
                        <input class="px-3 py-2 rounded-sm flex-grow" type="text" name="title" id="title" value="{!! $post->title !!}">
                    </div>

                    <div class="col-span-2 flex">
                        <label class="font-bold mr-2 py-2" for="author">Author</label>
                        <input class="px-3 py-2 rounded-sm flex-grow" type="text" name="author" id="author" value="{!! $post->author !!}">
                    </div>
                </div>

                <div class="grid grid-cols-4 col-span-4 gap-x-8 bg-white shadow rounded p-8">
                    <div class="col-span-4 flex">
                        <label class="font-bold mr-2 py-2" for="body">Body</label>
                        <textarea class="px-3 py-2 rounded-sm flex-grow" name="body" id="body" rows="20">{{ $post->body }}</textarea>
                    </div>
                </div>

                <div class="col-span-4 flex justify-end">
                    <button type="submit" class="bg-green-500 px-4 py-2 text-white font-bold hover:bg-green-900 shadow rounded">Save</button>
                </div>
            </div>
        </form>

        <div class="grid grid-cols-4 gap-4 gap-x-8 mt-8">
            @csrf()

            <div class="grid grid-cols-2 col-span-4 gap-16 gap-x-8 bg-white shadow rounded p-8 border-red-300 border-2 bg-red-200">
                <div>
                    <h2 class="font-bold text-xl text-red-900">
                        Slug
                    </h2>

                    <p>
                        Changing a post's slug might have unforeseen side-effects when already published.
                        We'll automatically add a redirect from the old to new slug, in order to prevent any issues.
                    </p>
                </div>

                <div class="flex items-center justify-end">
                    <form
                        action="{{ action(\App\Http\Controllers\UpdatePostSlugController::class, $post->slug) }}"
                        method="post"
                        class="flex flex-grow"
                    >
                        @csrf()

                        <input class="px-3 py-2 mr-2 rounded-sm flex-grow" type="text" name="slug" id="slug" value="{!! $post->slug !!}">
                        <button type="submit" class="bg-red-500 px-4 py-2 text-white font-bold hover:bg-red-900 shadow rounded">Update slug</button>
                    </form>
                </div>

                <div>
                    <h2 class="font-bold text-xl text-red-900">
                        Delete
                    </h2>

                    <p>
                        Think twice before deleting a post, this cannot be undone!
                    </p>
                </div>

                <div class="flex items-center justify-end">
                    <form
                        action="{{ action(\App\Http\Controllers\DeletePostController::class, $post->slug) }}"
                        method="post"
                        class="flex flex-grow justify-end"
                    >
                        @csrf()

                        <button type="submit" onclick="alert('Are you sure?')" class="bg-red-500 px-4 py-2 text-white font-bold hover:bg-red-900 shadow rounded">Delete Post</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

</x-app-layout>
