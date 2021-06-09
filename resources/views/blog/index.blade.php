@php
/** @var \App\Models\BlogPost[] $posts */
/** @var \App\Models\ExternalPost[] $recents */
@endphp

<x-guest-layout>
    <div class="prose mx-auto mt-16 mb-32">
        <h1>My Blog</h1>

        <ul>
            @foreach($posts as $post)
                <li>
                    <a
                        href="{{ action([\App\Http\Controllers\BlogPostController::class, 'show'], $post->slug) }}"
                        class="text-lg"
                    >
                        {{ $post->date->format('Y-m-d') }} –
                        <span class="font-bold">{{ $post->title }}</span>
                    </a>
                </li>
            @endforeach
        </ul>

        <h2>Recents from the community</h2>

        <ul>
            @foreach($recents as $recent)
                <li>
                    <a
                        href="{{ $recent->url }}"
                        class="text-lg"
                    >
                        {{ $recent->date->format('Y-m-d') }} –
                        <span class="font-bold">{{ $recent->title }}</span>
                        <br>
                        <span class="text-md">{{ $recent->domain }}</span>
                    </a>
                </li>
            @endforeach
        </ul>

        <div class="bg-green-100 p-8 rounded text-lg mt-4">
            Do you have another suggestion? Leave a link to an interesting blogpost here:

            <form action="{{ action(\App\Http\Controllers\ExternalPostSuggestionController::class) }}" method="post" class="mt-2 grid grid-cols-4 gap-y-2">
                @csrf()

                <label for="title" class="font-bold py-1 col-span-1">Title</label>
                <input type="text" name="title" class="col-span-3">

                <label for="url" class="font-bold py-1 col-span-1">URL</label>
                <input type="text" name="url" class="col-span-3">

                <div class="col-span-4 flex justify-end">
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-lg hover:bg-green-800">Suggest!</button>
                </div>
            </form>
        </div>
    </div>
</x-guest-layout>
