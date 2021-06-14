<x-guest-layout>
    <article>
        <header>
            <h1 class="mb-16 max-w-2xl font-display font-medium text-[2.5rem] lg:text-[5rem] leading-none">{{ $post->title }}</h1>
            <p class="max-w-2xl mx-auto flex items-center text-sm uppercase tracking-wider font-medium">
                <span>{{ $post->date->format('Y-m-d') }}</span>
                <span class="-mt-3 mx-2 font-display text-xl">.</span>
                <span>Written by {{ $post->author }}</span>
                <span class="-mt-3 mx-2 font-display text-xl">.</span>
                <a href="{{ action([\App\Http\Controllers\BlogPostController::class, 'index']) }}">Back</a>
            </p>
            <div class="mt-1">
                Written by {{ $post->author }} on {{ $post->date->format('Y-m-d') }} — 
            </div>
        </header>

        <main class="mt-8 max-w-2xl mx-auto">
            {!! $body !!}
        </main>

        <p>
            <livewire:vote-button :post="$post" /> — Written by {{ $post->author }} on {{ $post->date->format('Y-m-d') }} — <a href="{{ action([\App\Http\Controllers\BlogPostController::class, 'index']) }}">Back</a>
        </p>
    </article>
</x-guest-layout>
