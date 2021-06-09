<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Externals') }}
            </h2>
        </div>
    </x-slot>

    <div>
        @if($pending->isNotEmpty())
            <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
                <div class="grid">
                    <div class="
                        px-4
                        mb-2
                        font-bold
                        grid grid-cols-6
                    ">
                        <div class="col-span-2">Title</div>
                        <div class="col-span-2">URL</div>
                        <div class="col-span-1 pl-2">Date</div>
                        <div class="text-right col-span-1"></div>
                    </div>

                    @foreach($pending as $post)
                        <div class="
                            p-4
                            bg-blue-50
                            shadow
                            mb-2
                            rounded
                            grid grid-cols-6
                        ">
                            <div class="col-span-2">{{ $post->title }}</div>
                            <div class="col-span-2">
                                <a href="{{ $post->url }}" target="_blank" rel="noopener noreferrer" class="underline hover:no-underline">
                                    {{ $post->url }}
                                </a>
                            </div>
                            <div class="col-span-1 pl-2">{{ $post->date->format('Y-m-d') }}</div>
                            <div class="text-right col-span-1">
                                <div class="flex items-center justify-end">
                                    <a href="{{ action([\App\Http\Controllers\ExternalPostAdminController::class, 'approve'], $post) }}"
                                       class="bg-green-500 px-4 py-2 text-white font-bold hover:bg-green-900 shadow rounded text-sm"
                                    >
                                        Approve
                                    </a>
                                    <a href="{{ action([\App\Http\Controllers\ExternalPostAdminController::class, 'remove'], $post) }}"
                                       class="ml-2 bg-red-500 px-4 py-2 text-white font-bold hover:bg-red-900 shadow rounded text-sm"
                                    >
                                        Delete
                                    </a>
                                </div>
                            </div>
                        </div>
                    @endforeach
                </div>
            </div>
        @endif

        <div class="max-w-7xl mx-auto py-10 sm:px-6 lg:px-8">
            <div>
                <div class="
                    px-4
                    mb-2
                    font-bold
                    grid grid-cols-6
                ">
                    <div class="col-span-3">Title</div>
                    <div class="col-span-2">URL</div>
                    <div class="col-span-1 text-right">Date</div>
                </div>
                @foreach($active as $post)
                    <div class="
                        p-4
                        bg-white
                        shadow
                        mb-2
                        rounded
                        grid grid-cols-6
                    ">
                        <div class="col-span-3">{{ $post->title }}</div>
                        <div class="col-span-2">
                            <a href="{{ $post->url }}" target="_blank" rel="noopener noreferrer" class="underline hover:no-underline">
                                {{ $post->url }}
                            </a>
                        </div>
                        <div class="text-right col-span-1">{{ $post->date->format('Y-m-d') }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
