@if ($title)
    <h1>{{ $title }}</h1>
@endif

{{ \Illuminate\Mail\Markdown::parse($content) }}
