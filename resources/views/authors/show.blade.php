<x-guest-layout>
    <div class="mx-4 md:mx-8">
        <article class="max-w-7xl mx-auto mt-10 md:mt-20 mb-20">
            <div class="max-w-2xl md:flex mx-auto">
                    <div class="md:w-1/3">
                        <img class="w-32 h-32 rounded-full mx-auto" src="{{ asset('storage/resizes/256x256/'.$author->avatar) }}" alt="{{ $author->name }}">
                        <h1 class="font-bold text-xl text-center mt-4">{{ $author->name }}</h1>
                        <ul class="mt-2 text-sm text-gray-400 text-center">
                            @if($author->show_email)
                                <li class="my-2"><a href="mailto:{{ $author->email }}">{{ $author->email }}</a></li>
                            @endif
                        </ul>
                        <p class="md:hidden mt-4 text-sm leading-6 text-gray-500">{{ $author->bio }}</p>
                    </div>
                <div class="hidden md:block w-2/3">
                    <p class="mt-4 text-md leading-7 text-gray-500">{{ $author->bio }}</p>
                </div>
            </div>
            <h1 class="mt-20 text-center font-bold text-xl md:text-4xl">@lang('Take a look at my articles')</h1>
            <div class="mt-12 mb-20 mx-auto grid gap-2 md:gap-8 md:grid-cols-3 xl:grid-cols-4">
                @foreach($articles as $article)
                    @if($loop->first)
                        <div class="md:hidden border-b-2 border-gray-100"></div>
                    @endif
                    <x-post-card :post="$article"/>
                    @if(!$loop->last)
                        <div class="md:hidden border-b-2 border-gray-100"></div>
                    @endif
                @endforeach
            </div>
            {{ $articles->links() }}
        </article>
    </div>
</x-guest-layout>
