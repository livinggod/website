<x-guest-layout>
    <div class="pt-16 pb-20 lg:pt-16 lg:pb-28">
        <div class="max-w-7xl mx-auto">
            <a href="#" class="flex rounded-lg shadow-lg h-25">
                <div class="w-1/2 px-20 pt-4 rounded-l-lg">
                    <h2 class="text-sm md:text-lg text-gray-400">Article</h2>
                    <div class="mt-16">
                        <h1 class="text-lg md:text-5xl font-bold">Lorem ipsum dolor sit amet, consectetur adipisicing
                            elit.</h1>
                    </div>
                </div>
                <div class="w-1/2 relative">
                    <svg class="absolute h-full" viewBox="0 0 106 399" fill="none" xmlns="http://www.w3.org/2000/svg">
                        <path d="M0 399V0H106L0 399Z" fill="#fff"/>
                    </svg>
                    <img class="rounded-r-lg h-full w-full object-cover"
                         src="https://images.pexels.com/photos/2113566/pexels-photo-2113566.jpeg?auto=compress&cs=tinysrgb&dpr=2&h=750&w=1260"
                         alt="">
                </div>
            </a>
        </div>

        <div class="max-w-7xl mx-auto mt-20 text-gray-400">
            <div class="flex justify-between">
                <p>{{ __('New') }}</p>
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
            <div class="mt-4 max-w-lg mx-auto grid gap-8 lg:grid-cols-4 lg:max-w-none">
                @foreach($posts as $post)
                    <x-post-card :post="$post"/>
                @endforeach
            </div>
        </div>

        <div class="mt-20 shadow-inner bg-gray-100 py-10">
            <div class="max-w-5xl mx-auto">
                <h3 class="text-4xl text-custom-green-100">Be The First To Receive Our Content</h3>
                <p class="text-gray-400">Get our content directly in your inbox</p>
                <form class="mt-4 sm:flex sm:max-w-md">
                    <label for="emailAddress" class="sr-only">Email address</label>
                    <input type="email" name="emailAddress" id="emailAddress" autocomplete="email" required
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

        <div class="max-w-7xl mx-auto flex mt-20">
            <div class="w-1/3 flex flex-col">
                <img class="w-32 mx-auto" src="{{ asset('images/a.png') }}" alt="">
                <img class="w-32 mx-auto" src="{{ asset('images/b.png') }}" alt="">
                <img class="w-32 mx-auto" src="{{ asset('images/c.png') }}" alt="">
            </div>
            <div class="w-2/3">
                <h2 class="font-bold text-xl">
                    {!! $block->getCode('abc_homepage_title') !!}
                </h2>
                <p class="mt-4">
                    {!! $block->getCode('abc_homepage_content') !!}
                </p>
            </div>
        </div>
    </div>
</x-guest-layout>
