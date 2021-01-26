<x-guest-layout>
    <div class="pt-16 pb-20 px-4 sm:px-6 lg:pt-16 lg:pb-28 lg:px-8">
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

            <div class="mt-20 flex justify-between text-gray-400">
                <p>{{ __('new articles') }}</p>
                <a href="#">
                    {{ __('show all') }}
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

            <div class="flex mt-20">
                <div class="w-1/3 flex flex-col">
                    <img class="w-32 mx-auto" src="{{ asset('storage/a.png') }}" alt="">
                    <img class="w-32 mx-auto" src="{{ asset('storage/b.png') }}" alt="">
                    <img class="w-32 mx-auto" src="{{ asset('storage/c.png') }}" alt="">
                </div>
                <div class="w-2/3">
                    <h2 class="font-bold text-xl">The ABC's of salvation</h2>
                    <p class="mt-4">
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Aperiam atque eius eum ex qui quidem
                        rem voluptatum! Adipisci amet commodi consequatur cum deleniti dicta doloremque dolores eligendi
                        error et, excepturi illo ipsam ipsum laborum magnam minima necessitatibus omnis perferendis
                        possimus provident quaerat quas ratione recusandae saepe sit unde veniam voluptates!

                    </p>
                </div>
            </div>


        </div>
    </div>
</x-guest-layout>
