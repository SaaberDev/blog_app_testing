<button
    type="submit"
    {{ $attributes->merge(['class' => "
        px-4 py-2
        font-bold
        shadow rounded
        text-{$textColor}
        bg-{$color}-500
        hover:bg-{$color}-900
    "]) }}
>
    {{ $slot }}
</button>
