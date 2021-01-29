@props(['active'])

@php
$classes = ($active ?? false)
            ? 'inline-flex items-center text-base font-medium text-gray-900 border-b-2 border-custom-green-100 transition duration-150 ease-in-out'
            : 'inline-flex items-center text-base font-medium text-gray-500 hover:text-gray-700 border-b-2 border-transparent hover:border-gray-300 transition duration-150 ease-in-out';
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
