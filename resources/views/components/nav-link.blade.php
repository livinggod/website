@props(['active'])

@php
$responsive = 'border-l-2 md:border-l-0 pl-10 my-1 py-2 md:p-0 md:m-0';

$classes = ($active ?? false)
            ? 'inline-flex items-center text-base font-medium text-gray-900 md:border-b-2 border-livinggod-green-100 transition duration-150 ease-in-out ' . $responsive
            : 'inline-flex items-center text-base font-medium text-gray-500
            hover:text-gray-700 md:border-b-2 border-transparent hover:border-gray-300 transition duration-150 ease-in-out ' . $responsive;
@endphp

<a {{ $attributes->merge(['class' => $classes]) }}>
    {{ $slot }}
</a>
