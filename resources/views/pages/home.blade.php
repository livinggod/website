<x-guest-layout>
    <x-navbar/>
    <div class="relative pt-16 pb-20 px-4 sm:px-6 lg:pt-24 lg:pb-28 lg:px-8">
        <div class="relative max-w-7xl mx-auto">
            <div class="text-center">
                <h2 class="text-3xl tracking-tight font-extrabold text-gray-900 sm:text-4xl">
                    From the blog
                </h2>
                <p class="mt-3 max-w-2xl mx-auto text-xl text-gray-500 sm:mt-4">
                    Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ipsa libero labore natus atque, ducimus
                    sed.
                </p>
            </div>
            <div class="mt-12 max-w-lg mx-auto grid gap-5 lg:grid-cols-4 lg:max-w-none">
                @for($i = 0; $i < 4; $i++)
                    <div class="flex flex-col rounded-lg shadow-lg overflow-hidden">
                        <div class="flex-shrink-0">
                            <img class="h-48 w-full object-cover"
                                 src="https://images.unsplash.com/photo-1496128858413-b36217c2ce36?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=crop&w=1679&q=80"
                                 alt="">
                        </div>
                        <div class="flex-1 bg-white p-6 flex flex-col justify-between">
                            <div class="flex-1">
                                <p class="text-sm font-medium text-indigo-600">
                                    <a href="#" class="hover:underline">
                                        Article
                                    </a>
                                </p>
                                <a href="#" class="block mt-2">
                                    <p class="text-xl font-semibold text-gray-900">
                                        How God saved us from sin
                                    </p>
                                    <p class="mt-3 text-base text-gray-500">
                                        Lorem ipsum dolor sit amet consectetur adipisicing elit. Architecto accusantium
                                        praesentium eius, ut atque fuga culpa, similique sequi cum eos quis dolorum.
                                    </p>
                                </a>
                            </div>
                            <div class="mt-6 flex items-center">
                                <div class="flex-shrink-0">
                                    <a href="#">
                                        <span class="sr-only">Quinten Buis</span>
                                        <img class="h-10 w-10 rounded-full"
                                             src="https://images.unsplash.com/photo-1472099645785-5658abf4ff4e?ixlib=rb-1.2.1&ixid=eyJhcHBfaWQiOjEyMDd9&auto=format&fit=facearea&facepad=2&w=256&h=256&q=80"
                                             alt="">
                                    </a>
                                </div>
                                <div class="ml-3">
                                    <p class="text-sm font-medium text-gray-900">
                                        <a href="#" class="hover:underline">
                                            Quinten Buis
                                        </a>
                                    </p>
                                    <div class="flex space-x-1 text-sm text-gray-500">
                                        <time datetime="2020-03-16">
                                            Mar 16, 2020
                                        </time>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endfor
            </div>
        </div>
    </div>

    <div class="bg-white">
        <div class="max-w-7xl mx-auto px-4 py-12 sm:px-6 lg:py-16 lg:px-8">
            <div class="px-6 py-6 bg-custom-red rounded-lg md:py-12 md:px-12 lg:py-16 lg:px-16 xl:flex xl:items-center">
                <div class="xl:w-0 xl:flex-1">
                    <h2 class="text-2xl font-extrabold tracking-tight text-white sm:text-3xl">
                        Want to keep up with us?
                    </h2>
                    <p class="mt-3 max-w-3xl text-lg leading-6 text-indigo-200">
                        Let us notify you!
                    </p>
                </div>
                <div class="mt-8 sm:w-full sm:max-w-md xl:mt-0 xl:ml-8">
                    <form class="sm:flex">
                        <label for="emailAddress" class="sr-only">Email address</label>
                        <input id="emailAddress" name="emailAddress" type="email" autocomplete="email" required
                               class="w-full border-white px-5 py-3 placeholder-gray-500 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-indigo-700 focus:ring-white rounded-md"
                               placeholder="Enter your email">
                        <button type="submit"
                                class="mt-3 w-full flex items-center justify-center px-5 py-3 border border-transparent shadow text-base font-medium rounded-md bg-white hover:bg-indigo-400 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-indigo-700 focus:ring-white sm:mt-0 sm:ml-3 sm:w-auto sm:flex-shrink-0">
                            Notify me
                        </button>
                    </form>
                    <p class="mt-3 text-sm text-indigo-200">
                        We care about the protection of your data. Read our
                        <a href="#" class="text-white font-medium underline">
                            Privacy Policy.
                        </a>
                    </p>
                </div>
            </div>
        </div>
    </div>


    <x-footer/>
</x-guest-layout>
