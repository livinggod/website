<x-guest-layout>
    @if(!$post->isPublished())
        <x-draft/>
    @endif

    <div class="relative pb-16 bg-white overflow-hidden">
        <div class="relative px-4 sm:px-6 lg:px-8">

            <div class="mt-6 prose prose-lg text-gray-500 mx-auto">
                <article class="text-lg max-w-prose leading-9 mx-auto">
                    <div class="text-center">
                        <time class="text-xs md:text-sm w-full"
                              datetime="{{ \Illuminate\Support\Carbon::parse($post->publish_at)->format('Y-m-d') ?? '' }}">
                            {{ \Illuminate\Support\Carbon::parse($post->publish_at)->format('F jS Y') ?? '' }}
                        </time>
                    </div>
                    <h1>
                        <span
                            class="mt-2 block text-2xl text-center leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">{{ $post->title }}</span>
                        <span
                            class="mt-2 block text-lg text-center leading-8 font-extrabold tracking-tight text-gray-900 sm:text-2xl">{{ $post->description }}</span>
                    </h1>

                    <img class="mx-auto rounded-lg" src="{{ asset('storage/' . $post->image) }}" alt="">

                    <div class="flex m-0">
                        <img class="w-12 h-12 md:w-14 md:h-14 object-cover rounded-full"
                             src="{{ $post->user->getAvatar() }}"
                             alt="{{ $post->user->name }}">
                        <div class="text-sm md:text-base ml-4 self-center">
                            {{ __('Written by:') }} <a href="#" class="">{{ $post->user->name }}</a><br>
                            {{ $post->minutes }} {{ __('min read') }}
                        </div>
                    </div>

                    {!! \Advoor\NovaEditorJs\NovaEditorJs::generateHtmlOutput($post->content) !!}
                </article>
            </div>
        </div>
    </div>

    <script>
        var refTagger = {
            settings: {
                bibleVersion: "KJV",
                roundCorners: true,
                socialSharing: [],
                customStyle: {
                    heading: {
                        backgroundColor: "#ffffff",
                        color: "#000000"
                    },
                    body: {
                        color: "#000000"
                    }
                }
            }
        };
        (function (d, t) {
            var g = d.createElement(t), s = d.getElementsByTagName(t)[0];
            g.src = "//api.reftagger.com/v2/RefTagger.js";
            s.parentNode.insertBefore(g, s);
        }(document, "script"));
    </script>
</x-guest-layout>
