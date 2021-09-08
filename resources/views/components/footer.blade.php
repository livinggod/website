<footer class="bg-gray-100" aria-labelledby="footerHeading">
    <h2 id="footerHeading" class="sr-only">@lang('Footer')</h2>
    <div class="mx-auto py-12 px-4 sm:px-6 lg:pt-16 lg:pb-8 lg:px-8">
        <div class="max-w-7xl mx-auto">
            <div class="md:grid grid-cols-2 gap-8 xl:col-span-2">
                <x-footer.column title="latest articles">
                    @foreach(\App\Models\Post::getCachedLatestPosts(5) as $post)
                        <x-footer.link class="" href="{{ route('page', $post->slug) }}">
                            @limit($post->title, 30)
                        </x-footer.link>
                    @endforeach
                </x-footer.column>
                <div class="mt-12 md:mt-0">
                    <x-footer.column title="quick links">
                        <x-footer.link href="{{ route('page', 'articles') }}">@lang('All articles')</x-footer.link>
                        <x-footer.link href="{{ route('page', 'about') }}">@lang('About us')</x-footer.link>
                        <x-footer.link href="{{ route('page', 'what-we-believe') }}">@lang('What we believe')</x-footer.link>
                        <x-footer.link href="{{ route('page', 'abc') }}">@lang('The abc of salvation')</x-footer.link>
                    </x-footer.column>
                    <div class="mt-8">
                        <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">
                            @lang('Be the first to receive our content')
                        </h3>
                        <x-newsletter />
                    </div>
                </div>
            </div>
            <div class="mx-auto flex justify-center items-center mt-10">
                <a href="{{ store('facebook_social') }}" target="_blank" rel="noopener" class="mx-2 text-gray-400 hover:text-gray-500">
                    <x-bi-facebook class="h-6 w-6" />
                </a>
                <a href="{{ store('instagram_social') }}" target="_blank" rel="noopener" class="mx-2 text-gray-400 hover:text-gray-500">
                    <x-bi-instagram class="h-6 w-6" />
                </a>
            </div>
        </div>
    </div>
</footer>
