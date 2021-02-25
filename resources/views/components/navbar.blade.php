<div>
    <div id="dark-overlay"
         x-show="mobilemenu"
         x-transition:enter="transition duration-300"
         x-transition:enter-start="opacity-0"
         x-transition:enter-end="opacity-50"
         x-transition:leave="transition duration-300"
         x-transition:leave-start="opacity-50"
         x-transition:leave-end="opacity-0"
         class="hidden fixed inset-0 bg-black z-50 opacity-50"
    ></div>
    <div class="z-40 fixed w-full bg-white border-b">
        <div class="mx-auto px-4 sm:px-6">
            <div
                class="flex justify-between items-center h-16 md:justify-start md:space-x-10">
                <div class="flex justify-start lg:w-0 lg:flex-1">
                    <a href="{{ route('home') }}">
                        <span class="sr-only">Living God</span>
                        <x-application-logo class="h-6 w-auto sm:h-8"/>
                    </a>
                </div>
                <div class="-mr-2 -my-2 md:hidden">
                    <button type="button" @click="mobilemenu = true"
                            class="bg-white rounded-md p-2 inline-flex items-center justify-center text-gray-400 hover:text-gray-500 hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500">
                        <span class="sr-only">Open menu</span>
                        <!-- Heroicon name: menu -->
                        <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                             stroke="currentColor" aria-hidden="true">
                            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                                  d="M4 6h16M4 12h16M4 18h16"/>
                        </svg>
                    </button>
                </div>
                <nav class="hidden md:flex space-x-10 h-full">
                    <x-nav-link :href="route('articles.index')" :active="request()->segment(1) === 'articles'">
                        {{ __('Articles') }}
                    </x-nav-link>
                    <x-nav-link :href="route('pages.about')" :active="request()->segment(1) === 'about'">
                        {{ __('About') }}
                    </x-nav-link>
                    <x-nav-link :href="route('pages.abc')" :active="request()->segment(1) === 'abc'">
                        {{ __("The abc's") }}
                    </x-nav-link>
                </nav>
                <livewire:search />
            </div>
        </div>
    </div>

    <div id="mobilemenu" x-show="mobilemenu" @click.away="mobilemenu = false"
         x-transition:enter="transition ease-in duration-300"
         x-transition:enter-start="transform translate-x-full"
         x-transition:enter-end="transform translate-x-0"
         x-transition:leave="transition ease-out duration-300"
         x-transition:leave-start="transform translate-x-0"
         x-transition:leave-end="transform translate-x-full"
         class="hidden fixed right-0 z-60 w-4/5 h-full bg-white overflow-y-scroll">
        <div @click="mobilemenu = false" class="p-4 fixed right-0">
            <!-- Heroicon name: x -->
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M6 18L18 6M6 6l12 12"/>
            </svg>
        </div>
        <nav class="mt-16 flex flex-col">
            <x-nav-link :href="route('articles.index')" :active="request()->segment(1) === 'articles'">
                {{ __('Articles') }}
            </x-nav-link>
            <x-nav-link :href="route('pages.about')" :active="request()->segment(1) === 'about'">
                {{ __('About') }}
            </x-nav-link>
            <x-nav-link :href="route('pages.abc')" :active="request()->segment(1) === 'abc'">
                {{ __("The abc's") }}
            </x-nav-link>
        </nav>
    </div>
</div>
<div class="py-11"></div>
