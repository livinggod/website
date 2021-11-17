@if ($title)
    <h2>{{ $title }}</h2>
@endif

<iframe class="border-none w-full h-[395px]" src="{{ $video }}" title="{{ $title }}"
        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture"
        allowfullscreen
/>

