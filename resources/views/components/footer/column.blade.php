<div {{ $attributes->merge(['class' => '']) }}>
    <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">
        {{ __($title) }}
    </h3>
    <ul class="mt-4 space-y-4">
        {{ $slot }}
    </ul>
</div>
