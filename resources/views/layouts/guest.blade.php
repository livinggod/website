<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($title) ? $title . " | " . config('app.name', 'Laravel') : config('app.name', 'Laravel') }}</title>

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('safari-pinned-tab.svg') }}" color="#57b300">
    <meta name="msapplication-TileColor" content="#57b300">
    <meta name="theme-color" content="#ffffff">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ mix('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}" defer></script>

    @production
        {!! store('tracking_scripts') ?? '' !!}
    @endproduction
        <script defer data-domain="livinggod.test" src="https://plausible.io/js/plausible.js"></script>
        <script>window.plausible = window.plausible || function() { (window.plausible.q = window.plausible.q || []).push(arguments) }</script>

    {!! SEO::generate(true) !!}

    <livewire:styles />
    @stack('scripts')
</head>
<body x-data="{mobilemenu: false}" class="h-full" :class="{ 'overflow-y-hidden': mobilemenu === true}">
<x-navbar/>
<div class="font-sans text-gray-900 antialiased">
    @if(session()->has('message'))
        <x-flash-message />
    @endif
    {{ $slot }}
</div>
<x-footer/>
@include('cookieConsent::index')
<livewire:scripts />
</body>
</html>
