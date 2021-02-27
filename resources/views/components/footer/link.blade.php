<li>
    <a href="{{ $href }}" {{ $attributes->merge(['class' => 'text-base text-gray-500 hover:text-gray-900']) }}>
        {{ $slot }}
    </a>
</li>
