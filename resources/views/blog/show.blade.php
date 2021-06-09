<x-guest-layout>
    <article class="prose mx-auto mt-16 mb-32">
        <h1 class="mb-0 heading-level-1" style="margin-bottom: 0">
            {{ $post->title }}
        </h1>

        <div class="mt-1">
            <livewire:vote-button :post="$post" /> — Written by {{ $post->author }} on {{ $post->date->format('Y-m-d') }} — <a href="{{ action([\App\Http\Controllers\BlogPostController::class, 'index']) }}">Back</a>
        </div>

        {!! $body !!}

        <hr>

        <p>
            <livewire:vote-button :post="$post" /> — Written by {{ $post->author }} on {{ $post->date->format('Y-m-d') }} — <a href="{{ action([\App\Http\Controllers\BlogPostController::class, 'index']) }}">Back</a>
        </p>
    </article>
</x-guest-layout>
