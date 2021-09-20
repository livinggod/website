@props(['post'])

<div {{ $attributes->merge(['class' => 'relative md:flex md:flex-col md:rounded-lg md:shadow-md md:overflow-hidden transition duration-300 md:hover:shadow-xl']) }}>
    <a class="absolute w-full h-full" href="{{ route('page', $post->slug) }}"></a>
    <div class="hidden md:block flex-shrink-0">
        <a href="{{ route('page', $post->slug) }}">
            <img class="h-48 w-full object-cover"
                 src="{{ asset('storage/resizes/600/' . $post->image) }}"
                 alt="">
        </a>
    </div>
    <div class="flex-1 bg-white p-4 md:p-6 flex flex-col justify-between">
        <div class="flex-1">
            <div class="flex justify-between">
                <div>
                    <p class="text-xs md:text-sm font-medium text-indigo-600">
                        <a href="{{ route('page', $post->topic->slug) }}" class="relative z-10 hover:underline -ml-2 p-2 md:m-0 md:p-0">
                            {{ $post->topic->name }}
                        </a>
                    </p>
                    <a href="{{ route('page', $post->slug) }}" class="block mt-2 mr-4">
                        <p class="text-md md:text-xl font-semibold text-gray-900">
                            {{ $post->title }}
                        </p>
                        <p class="hidden md:block text-md mt-2 text-gray-500">
                            @limit($post->description, 80)
                        </p>
                        <p class="md:hidden text-sm text-gray-500">
                            @limit($post->description, 20)
                        </p>
                    </a>
                </div>
                <img class="md:hidden h-20 w-20 object-cover rounded-lg"
                     src="{{ asset('storage/resizes/200x200/' . $post->image) }}"
                     alt="">
            </div>
        </div>
        <div class="md:hidden mt-4 text-xs md:text-xs text-gray-500">
            {{ $post->calculateRead() }} @lang('min read')
        </div>
        <div class="mt-2 md:mt-6 flex w-full">
            <a class="hidden md:block relative z-10" href="{{ route('page', $post->user->slug) }}">
                <img class="w-8 h-8 md:w-10 md:h-10 object-cover rounded-full"
                     src="{{ asset('storage/resizes/80x80/'.$post->user->avatar) }}"
                     alt="">
            </a>

            <div class="flex md:block gap-2 md:ml-4">
                <p class="text-xs md:text-sm font-medium text-gray-900">
                    <a href="{{ route('page', $post->user->slug) }}" class="relative z-10 hover:underline w-6 text-wrap p-2 -mx-2">
                        {{ $post->user->name }}
                    </a>
                </p>
                <div class="flex text-xs ml-2 md:ml-0 md:text-xs text-gray-500">
                    <time datetime="{{ \App\Extensions\Locale\Locale::parse($post->publish_at, 'Y-m-d') ?? '' }}">
                        {{ \App\Extensions\Locale\Locale::parse($post->publish_at) }}
                    </time>
                </div>
                <div class="hidden md:block mt-2 text-xs md:text-xs text-gray-500">
                    {{ $post->calculateRead() }} @lang('min read')
                </div>
            </div>
        </div>
    </div>
</div>
