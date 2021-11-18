@if ($title)
    <h2>{{ $title }}</h2>
@endif

{{ \Illuminate\Mail\Markdown::parse($content) }}
