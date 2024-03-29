<form @submit="plausible('{{ config('plausible.events.newsletter') }}')" action="{{ route('newsletter.store') }}" method="post" class="newsletter | mt-4 sm:flex sm:max-w-md">
    @csrf
    <div>
        @include('components.inputs.input')
        <div class="mt-3">
            {!! \Anhskohbo\NoCaptcha\Facades\NoCaptcha::display() !!}
        </div>
        @if ($errors->has('g-recaptcha-response'))
            <span class="test-red-600">{{ $errors->first('g-recaptcha-response') }}</span>
        @endif
    </div>
    <div class="mt-3 rounded-md sm:mt-0 sm:ml-3 sm:flex-shrink-0">
        @include('components.inputs.button', ['text' => __('Subscribe')])
    </div>
</form>
