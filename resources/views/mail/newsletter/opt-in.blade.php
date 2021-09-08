@component('mail::message')
# @lang('Confirm that we can send updates directly to your inbox')

@lang('Click the button below to start receiving updates.')

@component('mail::button', ['url' => $url])
@lang('Confirm my subscription')
@endcomponent

@lang('Thanks,')<br>
{{ config('app.name') }}
@endcomponent
