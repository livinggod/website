<x-guest-layout>
    <div class="relative py-16 bg-white overflow-hidden">
        <div class="relative px-4 sm:px-6 lg:px-8">

            <div class="mt-6 prose prose-indigo prose-lg text-gray-500 mx-auto">
                <div class="text-lg max-w-prose mx-auto">
                    <h1>
                        <span
                            class="mt-2 block text-3xl text-center leading-8 font-extrabold tracking-tight text-gray-900 sm:text-4xl">{{ $post->title }}</span>
                    </h1>
                    <img class="mx-auto" src="{{ asset('storage/' . $post->image) }}" alt="">
                </div>
                {!! \Advoor\NovaEditorJs\NovaEditorJs::generateHtmlOutput($post->content) !!}
            </div>
        </div>
    </div>

    <script>
        var refTagger = {
            settings: {
                bibleVersion: "ESV",
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
