<div {{ $attributes->merge(['class' => 'inline-block relative text-left']) }} x-data="{open: false}">
    <div>
        <button
            x-on:click="open = !open"
            type="button"
            class="rounded-full flex items-center text-gray-400 hover:text-gray-600 focus:outline-none"
            id="menu-button"
            aria-expanded="true"
            aria-haspopup="true"
        >
            {{ app()->currentLocale() }}
            <span class="sr-only">@lang('Open languages')</span>
            <x-heroicon-s-chevron-down class="h-5 w-5" />
        </button>
    </div>

    <div x-cloak
         x-show="open"
         class="origin-top-right absolute right-0 mt-2 rounded-md shadow-lg bg-white ring-1 ring-black ring-opacity-5 focus:outline-none"
         role="menu"
         aria-orientation="vertical"
         aria-labelledby="menu-button"
         tabindex="-1"
         x-transition:enter="transition ease-out duration-100"
         x-transition:enter-start="transform opacity-0 scale-95"
         x-transition:enter-end="transform opacity-100 scale-100"
         x-transition:leave="transition ease-in duration-75"
         x-transition:leave-start="transform opacity-100 scale-100"
         x-transition:leave-end="transform opacity-0 scale-95"
    >
        <div class="py-1" role="none">
            @foreach(config('localization.allowed_locales') as $key => $locale)
                <a href="{{ $locale['domain'].request()->path() }}" class="text-gray-700 block px-4 py-2 text-sm" role="menuitem" tabindex="-1">{{ $key }}</a>
            @endforeach
        </div>
    </div>
</div>
