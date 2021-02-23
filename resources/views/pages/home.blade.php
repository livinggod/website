<x-guest-layout>
    <div class="pt-8 md:pt-16 pb-20 lg:pt-16 lg:pb-28">
        @if(!is_null($highlight))
            <div class="md:mx-8">
                <div
                    class="lg:max-w-7xl mx-auto relative rounded-lg shadow-md transition duration-300 md:hover:shadow-xl">
                    <a class="absolute w-full h-full z-20" href="{{ route("articles.show", $highlight) }}"></a>
                    <div class="flex flex-col md:flex-row md:min-h-80 lg:min-h-120">
                        <img class="md:hidden rounded-t-lg md:rounded-r-lg h-15 w-full object-cover"
                             src="{{ asset('storage/' . $highlight->image) }}"
                             alt="{{ $highlight->title }}">
                        <div
                            class="md:w-1/2 md:px-20 p-4 -mt-2 bg-white rounded-lg md:rounded-l-lg flex flex-col justify-between">
                            <h2 class="text-sm md:text-lg text-gray-400">{{ $highlight->category->name }}</h2>
                            <div class="md:mt-4 lg:mt-6">
                                <h1 class="text-2xl lg:text-4xl font-bold mt-4">{{ $highlight->title }}</h1>
                                <h2 class="text-md lg:text-lg text-gray-500 mt-2 mb-4">{{ $highlight->description }}</h2>
                            </div>
                            <div class="flex mt-8 mb-4">
                                <a href="{{ route('authors.show', $highlight->user) }}">
                                    <img class="relative w-8 h-8 z-30 md:w-10 md:h-10 object-cover rounded-full"
                                         src="{{ $highlight->user->getAvatar() }}"
                                         alt="{{ $highlight->user->name }}">
                                </a>
                                <div class="ml-4">
                                    <a href="{{ route('authors.show', $highlight->user) }}"
                                       class="relative z-30 text-xs md:text-sm font-medium hover:underline w-6 text-wrap text-gray-900">
                                        {{ $highlight->user->name }}
                                    </a>
                                    <div class="flex space-x-1 text-xs md:text-sm text-gray-500">
                                        <time
                                            datetime="{{ \Illuminate\Support\Carbon::parse($highlight->publish_at)->format('Y-m-d') ?? '' }}">
                                            {{ \Illuminate\Support\Carbon::parse($highlight->publish_at)->format('F jS Y') ?? '' }}
                                        </time>
                                    </div>
                                    <div class="mt-2 text-xs md:text-sm text-gray-500">
                                        {{ $highlight->minutes }} {{ __('min read') }}
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="hidden md:block w-1/2 relative">
                            <svg class="absolute h-full z-10" viewBox="0 0 106 399" fill="none"
                                 xmlns="http://www.w3.org/2000/svg">
                                <path d="M0 399V0H106L0 399Z" fill="#fff"/>
                            </svg>
                            <img class="rounded-r-lg h-full w-full object-cover absolute"
                                 src="{{ asset('storage/' . $highlight->image) }}"
                                 alt="{{ $highlight->title }}">
                        </div>
                    </div>
                </div>
            </div>
        @endif
        <div class="mx-4 md:mx-8">
            <div class="max-w-7xl mx-auto mt-20 text-gray-400">
                <div class="flex justify-between h-10">
                    <a href="{{ route('articles.index') }}"
                       class="border-b-2 md:border-0 border-custom-green-100 text-custom-green-100 md:text-gray-400">
                        {{ __('New') }}
                    </a>
                    <a href="{{ route('articles.index') }}">
                        {{ __('Show all') }}

                        {{-- Hericon: arrow-narrow-right --}}
                        <svg class="inline w-4 fill-current"
                             xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor">
                            <path fill-rule="evenodd"
                                  d="M12.293 5.293a1 1 0 011.414 0l4 4a1 1 0 010 1.414l-4 4a1 1 0 01-1.414-1.414L14.586 11H3a1 1 0 110-2h11.586l-2.293-2.293a1 1 0 010-1.414z"
                                  clip-rule="evenodd"/>
                        </svg>
                    </a>
                </div>
                <div class="mx-auto grid gap-2 md:gap-8 md:grid-cols-3 xl:grid-cols-4">
                    @foreach($posts as $post)
                        @if($loop->first)
                            <div class="md:hidden border-b-2 border-gray-100"></div>
                        @endif
                        <x-post-card :post="$post"/>
                        @if(!$loop->last)
                            <div class="md:hidden border-b-2 border-gray-100"></div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>


        <div class="mt-20 shadow-inner bg-gray-100 py-10">
            <div class="mx-4 md:mx-8">
                <div class="max-w-5xl mx-auto">
                    <h3 class="text-lg md:text-4xl text-custom-green-100">Be The First To Receive Our Content</h3>
                    <p class="text-md text-gray-400">Get our content directly in your inbox</p>
                    <form action="{{ route('newsletter.store') }}" method="post" class="mt-4 sm:flex sm:max-w-md">
                        @csrf
                        <label for="email" class="sr-only">Email address</label>
                        <input type="email" name="email" id="email" autocomplete="email" required
                               class="appearance-none min-w-0 w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-4 text-base text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:placeholder-gray-400"
                               placeholder="Enter your email">
                        <div class="mt-3 rounded-md sm:mt-0 sm:ml-3 sm:flex-shrink-0">
                            <button type="submit"
                                    class="w-full bg-custom-green-100 flex items-center justify-center border border-transparent rounded-md py-2 px-4 text-base font-medium text-white focus:outline-none hover:bg-custom-green-200 focus:bgwewe-custom-green-300">
                                Subscribe
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="mx-4 md:mx-10">
            <div class="max-w-7xl mx-auto md:flex mt-20">
                <div class="md:w-1/3 flex md:flex-col justify-center">
                    <img class="w-20 h-16 md:w-32 md:h-auto md:mx-auto" src="{{ asset('images/a.png') }}" alt="">
                    <img class="w-20 h-16 md:w-32 md:h-auto md:mx-auto" src="{{ asset('images/b.png') }}" alt="">
                    <img class="w-20 h-16 md:w-32 md:h-auto md:mx-auto" src="{{ asset('images/c.png') }}" alt="">
                </div>
                <div class="w-full md:w-2/3 mt-6 md:mt-0">
                    <h2 class="font-bold text-xl">
                        {!! getBlock('abc_homepage_title') !!}
                    </h2>
                    <p class="mt-4">
                        {!! getBlock('abc_homepage_content') !!}
                    </p>
                </div>
            </div>
        </div>
    </div>

    <script>
        const redirect = (url) => {
            window.location = url;
        };
    </script>
</x-guest-layout>
