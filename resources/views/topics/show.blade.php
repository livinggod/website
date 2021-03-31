<x-guest-layout>
    <div class="mx-4 md:mx-8">
        <article class="max-w-7xl mx-auto mt-10 md:mt-20 mb-20">
            <h1 class="text-center font-bold text-xl md:text-4xl">{{ $topic->name }}</h1>
            <h2 class="text-center text-gray-400 text-md md:text-lg mt-6">{{ limit($topic->description, 255) }}</h2>
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
