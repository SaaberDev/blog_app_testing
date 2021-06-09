<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Redirects') }}
            </h2>
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
                    <div class="w-1/3">From</div>
                    <div class="w-1/3">To</div>
                    <div class="w-1/3 text-right">Active since</div>
                    </div>
                </div>
                @foreach($redirects as $redirect)
                    <div class="
                        p-4
                        bg-white
                        shadow
                        mb-2
                        rounded
                        flex
                        justify-between
                    ">
                        <div class="w-1/3">{{ $redirect->from }}</div>
                        <div class="w-1/3">
                            <a href="{{ $redirect->to }}" target="_blank" rel="noopener noreferrer" class="underline hover:no-underline">
                                {{ $redirect->to }}
                            </a>
                        </div>
                        <div class="w-1/3 text-right">{{ $redirect->created_at->format('Y-m-d H:i:s') }}</div>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
</x-app-layout>
