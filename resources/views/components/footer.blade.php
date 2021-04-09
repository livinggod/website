<footer class="bg-gray-100" aria-labelledby="footerHeading">
    <h2 id="footerHeading" class="sr-only">Footer</h2>
    <div class="mx-auto py-12 px-4 sm:px-6 lg:pt-16 lg:pb-8 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="md:grid grid-cols-2 gap-8 xl:col-span-2">
                <x-footer.column title="latest articles">
                    @foreach(getLatestPosts(5) as $post)
                        <x-footer.link class="" href="{{ route('page', $post->slug) }}">
                            {{ limit($post->title, 30) ?? '' }}
                        </x-footer.link>
                    @endforeach
                </x-footer.column>
                <div class="mt-12 md:mt-0">
                    <x-footer.column title="quick links">
                        <x-footer.link href="{{ route('page', 'articles') }}">All articles</x-footer.link>
                        <x-footer.link href="{{ route('page', 'about') }}">About us</x-footer.link>
                        <x-footer.link href="{{ route('page', 'what-we-believe') }}">What we believe</x-footer.link>
                        <x-footer.link href="{{ route('page', 'abc') }}">The abc's of salvation</x-footer.link>
                    </x-footer.column>
                    <div class="mt-8">
                        <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">
                            @lang('Be the first to receive our content')
                        </h3>
                        <form action="{{ route('newsletter.store') }}" method="post" class="mt-4 sm:flex sm:max-w-md">
                            @csrf
                            @include('components.inputs.input')
                            <div class="mt-3 rounded-md sm:mt-0 sm:ml-3 sm:flex-shrink-0">
                                @include('components.inputs.button', ['text' => 'Subscribe'])
                            </div>
                        </form>
                    </div>
                </div>
            </div>
            <div class="mx-auto flex justify-center mt-10">
                <a href="https://www.facebook.com/Living-God-102595761894322/" target="_blank" rel="nofollow"  class="mx-2 text-gray-400 hover:text-gray-500">@include('components.icons.facebook')</a>
                <a href="https://www.instagram.com/livinggodofficial/" target="_blank" rel="nofollow" class="mx-2 text-gray-400 hover:text-gray-500">@include('components.icons.instagram')</a>
            </div>
        </div>
    </div>
</footer>
