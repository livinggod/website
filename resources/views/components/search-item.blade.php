<div {{ $attributes->merge(['class' => 'relative transition duration-300']) }}>
    <a class="absolute w-full h-full" href="{{ route('articles.show', $post) }}"></a>
    <div class="flex-1 bg-white p-4 flex flex-col justify-between">
        <div class="flex-1">
            <div class="flex justify-between">
                <div>
                    <p class="text-xs font-medium text-indigo-600">
                        <a href="{{ route('topics.show', $post->category) }}" class="relative z-10 hover:underline -ml-2 p-2">
                            {{ $post->category->name }}
                        </a>
                    </p>
                    <a href="{{ route('articles.show', $post) }}" class="block mt-2 mr-4">
                        <p class="text-md font-semibold text-gray-900">
                            {{ $post->title }}
                        </p>
                        <p class="text-sm text-gray-500">
                            {{ \Illuminate\Support\Str::limit($post->description, 20) ?? '' }}
                        </p>
                    </a>
                </div>
                <img class="h-20 w-20 object-cover rounded-lg"
                     src="{{ asset('storage/' . $post->image) }}"
                     alt="">
            </div>
        </div>
        <div class="mt-4 text-xs text-gray-500">
            {{ $post->minutes }} {{ __('min read') }}
        </div>
        <div class="mt-2 flex w-full">
            <div class="flex gap-2">
                <p class="text-xs font-medium text-gray-900">
                    <a href="{{ route('authors.show', $post->user) }}" class="relative z-10 hover:underline w-6 text-wrap p-2 -mx-2">
                        {{ $post->user->name }}
                    </a>
                </p>
                <div class="flex text-xs ml-2 text-gray-500">
                    <time datetime="{{ \Illuminate\Support\Carbon::parse($post->publish_at)->format('Y-m-d') ?? '' }}">
                        {{ \Illuminate\Support\Carbon::parse($post->publish_at)->format('F jS Y') ?? '' }}
                    </time>
                </div>
                <div class="hidden mt-2 text-xs text-gray-500">
                    {{ $post->minutes }} {{ __('min read') }}
                </div>
            </div>
        </div>
    </div>
</div>
