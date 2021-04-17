<x-guest-layout>
    <div class="relative pb-16 bg-white overflow-hidden">
        <div class="relative px-4 sm:px-6 lg:px-8">
            <div class="mt-6 prose prose-lg text-gray-500 mx-auto">
                <article class="text-lg max-w-prose leading-9 mx-auto">

                    <div class="relative min-h-[400px]">
                        <img class="mx-auto rounded-lg" src="{{ asset('storage/resizes/700x700/' . $page->image) }}" alt="">
                        <div class="absolute inset-0 bg-gradient-to-t from-black rounded-lg"></div>
                        <p class="absolute bottom-0 left-0 text-white font-bold text-2xl md:text-4xl mx-6">{{ $page->title }}</p>
                    </div>

                    {!! \Advoor\NovaEditorJs\NovaEditorJs::generateHtmlOutput($page->content) !!}
                </article>
            </div>
        </div>
    </div>

    <x-reftagger />
</x-guest-layout>
