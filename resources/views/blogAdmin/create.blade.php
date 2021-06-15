<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-display font-semibold text-xl text-ink leading-tight">
                New Blog Post
            </h2>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8 py-4">
        <form
            action="{{ action([\App\Http\Controllers\BlogPostAdminController::class, 'store']) }}"
            method="post"
        >
            <div class="grid grid-cols-4 gap-4 gap-x-8">
                @csrf()

                <div class="grid grid-cols-4 col-span-4 gap-x-8 gap-y-4 bg-white shadow rounded p-8">
                    <div class="col-span-2 flex">
                        <label class="font-bold mr-2 py-2" for="title">Title</label>
                        <input class="px-3 py-2 rounded-sm flex-grow" type="text" name="title" id="title" value="{!! $post->title !!}">
                    </div>

                    <div class="col-span-2 flex">
                        <label class="font-bold mr-2 py-2" for="author">Author</label>
                        <input class="px-3 py-2 rounded-sm flex-grow" type="text" name="author" id="author" value="{!! $post->author !!}">
                    </div>

                    <div class="col-span-2 flex">
                        <label class="font-bold mr-2 py-2" for="date">Date</label>
                        <input class="px-3 py-2 rounded-sm flex-grow" type="date" name="date" id="date" value="{!! $post->date->format('Y-m-d') !!}">
                    </div>
                </div>

                <div class="grid grid-cols-4 col-span-4 gap-x-8 bg-white shadow rounded p-8">
                    <div class="col-span-4 flex">
                        <label class="font-bold mr-2 py-2" for="body">Body</label>
                        <textarea class="px-3 py-2 rounded-sm flex-grow" name="body" id="body" rows="20">{{ $post->body }}</textarea>
                    </div>
                </div>

                <div class="col-span-4 flex justify-end">
                    <button type="submit" class="bg-green-500 px-4 py-2 text-white font-bold hover:bg-green-900 shadow rounded">Create</button>
                </div>
            </div>
        </form>
    </div>

</x-app-layout>
