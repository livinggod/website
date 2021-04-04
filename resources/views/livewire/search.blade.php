<div class="hidden md:flex items-center justify-end md:flex-1 lg:w-0 relative">
    @if($active)
        <input wire:model.debounce.200ms="search" class="w-3/4 rounded-full" type="text" placeholder="Search">

        @if($search !== '')
            <div class="absolute w-full lg:w-3/4 top-0 bg-white min-h-10 mt-12 z-1000 shadow-lg border-2 border-gray-100 grid gap-2">
                @if(!$items->isEmpty())
                    @foreach($items as $post)
                        @if ($loop->index === 5)
                            @break
                        @endif
                        <a href="{{ route('page', $post->slug) }}" class="absolute inset-0"></a>
                        <div class="flex px-10 py-2">
                            <img class="h-12 w-12 object-cover rounded-lg"
                                 src="{{ asset('storage/' . $post->image) }}"
                                 alt="">
                            <div class="ml-6">
                                <a href="{{ route('page', $post->category->slug) }}" class="relative z-10 hover:underline text-gray-400 p-1 -ml-1 text-xs">
                                    {{ $post->category->name }}
                                </a>
                                <p class="mt-1 text-sm font-bold">{{ \Illuminate\Support\Str::limit($post->title, 50) }}</p>
                                <p class="text-gray-400 mt-1 text-xs">
                                    <a href="{{ route('page', $post->user->slug) }}" class="hover:underline relative z-10 p-1 -ml-1">{{ $post->user->name }}</a>
                                    {{ \Illuminate\Support\Carbon::parse($post->publish_at)->format('F jS Y') ?? '' }}
                                </p>
                            </div>
                        </div>
                        @if(!$loop->last)
                            <div class="border-b-2 border-gray-100"></div>
                        @else
                                <div class="mt-2"></div>
                        @endif
                    @endforeach
                    @if ($items->count() > 5)
                            <div class="mt-1 font-bold mx-auto pb-2 text-gray-400">{{ $items->count() - 5 }} more results...</div>
                    @endif
                @else
                    <div class="font-bold mx-auto py-2 text-gray-400">No search results...</div>
                @endif
            </div>
        @endif
    @endif
    <button wire:click="toggle" class="absolute mr-4 focus:outline-none text-gray-400 hover:text-gray-500">
        @if(!$active)
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none" viewBox="0 0 24 24"
                 stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M21 21l-6-6m2-5a7 7 0 11-14 0 7 7 0 0114 0z"/>
            </svg>
        @else
            <svg class="h-6 w-6" xmlns="http://www.w3.org/2000/svg" fill="none"
                 viewBox="0 0 24 24"
                 stroke="currentColor" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2"
                      d="M6 18L18 6M6 6l12 12"/>
            </svg>
        @endif
    </button>
</div>
