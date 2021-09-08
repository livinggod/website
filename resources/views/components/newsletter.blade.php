<form @submit="plausible('test')" action="{{ route('newsletter.store') }}" method="post" class="newsletter | mt-4 sm:flex sm:max-w-md">
    @csrf
    @include('components.inputs.input')
    <div class="mt-3 rounded-md sm:mt-0 sm:ml-3 sm:flex-shrink-0">
        @include('components.inputs.button', ['text' => __('Subscribe')])
    </div>
</form>
