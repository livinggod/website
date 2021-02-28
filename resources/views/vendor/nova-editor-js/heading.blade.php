@php($level = $level === 1 ? 2 : $level)

<div class="editor-js-block">
    <{{ "h{$level}" }}>
        {{ $text }}
    </{{ "h{$level}" }}>
</div>
