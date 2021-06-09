<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Redirects') }}
            </h2>
        </div>
    </x-slot>

    <div>
        <x-table>
            <x-row header cols="3">
                <x-column>From</x-column>
                <x-column>To</x-column>
                <x-column right>Active since</x-column>
            </x-row>

            @foreach($redirects as $redirect)
                <x-row cols="3">
                    <x-column>{{ $redirect->from }}</x-column>
                    <x-column>
                        <a href="{{ $redirect->to }}" target="_blank" rel="noopener noreferrer" class="underline hover:no-underline">
                            {{ $redirect->to }}
                        </a>
                    </x-column>
                    <x-column right>{{ $redirect->created_at->format('Y-m-d H:i:s') }}</x-column>
                </x-row>
            @endforeach
        </x-table>
    </div>
</x-app-layout>
