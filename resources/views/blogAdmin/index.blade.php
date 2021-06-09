<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Blog') }}
            </h2>

            <a href="{{ action([\App\Http\Controllers\BlogPostAdminController::class, 'create']) }}"
               class="bg-green-500 px-4 py-2 text-white font-bold hover:bg-green-900 shadow rounded text-sm"
            >
                New
            </a>
        </div>
    </x-slot>

    <div>
        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div class="grid">
                <div class="
                    px-4
                    flex
                    justify-between
                    mb-2
                    font-bold
                ">
                    <div class="w-1/2">Title</div>
                    <div class="text-right">Date</div>
                    <div class="text-right">Author</div>
                    <div class="text-right pr-2">
                    </div>
                </div>
                @foreach($posts as $post)
                    <div class="
                        p-4
                        bg-white
                        shadow
                        mb-2
                        rounded
                        flex
                        justify-between
                    ">
                        <div class="w-1/2">{{ $post->title }}</div>
                        <div class="text-right">{{ $post->date->format('Y-m-d') }}</div>
                        <div class="text-right">{{ $post->author }}</div>
                        <div class="text-right pr-2">
                            <a href="{{ action([\App\Http\Controllers\BlogPostAdminController::class, 'edit'], $post->slug) }}" class="font-bold">
                                Edit
                            </a>
                        </div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
