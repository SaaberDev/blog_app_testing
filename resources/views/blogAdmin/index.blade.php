@php
    /** @var \App\Models\BlogPost[] $posts[] */
@endphp

<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Blog') }}
            </h2>

            <div>
                <x-button
                    :href="action([\App\Http\Controllers\BlogPostAdminController::class, 'create'])"
                    class="mr-2"
                >
                    New
                </x-button>

                <x-button
                    :href="action([\App\Http\Controllers\BlogPostController::class, 'index'])"
                    target="_blank" rel="noopener noreferrer"
                    color="blue"
                >
                    Show
                </x-button>
            </div>
        </div>
    </x-slot>

    <x-table>
        @if ($errors->any())
            <div class="text-red-800">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <x-row cols="6" header>
            <x-column colspan="2">Title</x-column>
            <x-column right>Date</x-column>
            <x-column right>Author</x-column>
            <x-column right>Status</x-column>
            <x-column right></x-column>
        </x-row>

        @foreach($posts as $post)
            <x-row cols="6">
                <x-column colspan="2">{{ $post->title }}</x-column>
                <x-column right>{{ $post->date->format('Y-m-d') }}</x-column>
                <x-column right>{{ $post->author }}</x-column>
                <x-column right>
                        <span class="text-{{ $post->status->color() }}-500 font-bold">
                            {{ $post->status->label() }}
                        </span>
                </x-column>
                <x-column right>
                    <div class="flex justify-between">

                    </div>
                    @if(! $post->isPublished())
                        <form
                            action="{{ action([\App\Http\Controllers\BlogPostAdminController::class, 'publish'], $post->slug) }}"
                            method="post"
                        >
                            @csrf()

                            <x-button class="mr-2" color="blue" name="publish" class="text-sm" color="green">Publish</x-button>
                        </form>
                    @endif

                    <x-button
                        :href="action([\App\Http\Controllers\BlogPostAdminController::class, 'edit'], $post->slug)"
                        color="blue"
                        class="ml-2"
                    >
                        Edit
                    </x-button>
                </x-column>
            </x-row>
        @endforeach
    </x-table>
</x-app-layout>
