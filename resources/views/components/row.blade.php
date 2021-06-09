<div class="
    grid grid-cols-{{ $cols }}

    @if($header)
        px-4 mb-2
        font-bold
    @else
        p-4
        bg-white
        border-b-2 border-gray-100
    @endif

    bg-{{ $color }}-100
">
    {{ $slot }}
</div>
