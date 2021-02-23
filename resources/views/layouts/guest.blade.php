<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ isset($title) ? $title . " | " . config('app.name', 'Laravel') : config('app.name', 'Laravel') }}</title>

    <!-- Favicon -->
    <link rel="apple-touch-icon" sizes="180x180" href="{{ asset('images/favicon/apple-touch-icon.png') }}">
    <link rel="icon" type="image/png" sizes="32x32" href="{{ asset('images/favicon/favicon-32x32.png') }}">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('images/favicon/favicon-16x16.png') }}">
    <link rel="manifest" href="{{ asset('site.webmanifest') }}">
    <link rel="mask-icon" href="{{ asset('images/favicon/safari-pinned-tab.svg') }}" color="#57b300">
    <meta name="msapplication-TileColor" content="#57b300">
    <meta name="theme-color" content="#ffffff">

    <!-- Fonts -->
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap">

    <!-- Styles -->
    <link rel="stylesheet" href="{{ asset('css/app.css') }}">

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- SEO -->
    <meta name="keywords" content="{{ $keywords ?? '' }}">
    <meta name="title" content="{{ $title ?? '' }}">
    <meta name="description" content="{{ $description ?? '' }}">
    <meta name="author" content="{{ $author ?? '' }}">
    <meta name="image" content="{{ $image ?? '' }}">

    <meta name="og:title" content="{{ $title ?? '' }}">
    <meta name="og:url" content="{{ url()->current() }}">
    <meta name="og:type" content="{{ $type ?? '' }}">
    <meta name="og:image" content="{{ $image ?? '' }}">
    <meta name="og:description" content="{{ $description ?? '' }}">
</head>
<body x-data="{mobilemenu: false}" class="h-full" :class="{ 'overflow-y-hidden': mobilemenu === true}">
<x-navbar/>
<div class="font-sans text-gray-900 antialiased">
    {{ $slot }}
</div>
<x-footer/>
@include('cookieConsent::index')
</body>
</html>
