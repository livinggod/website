<div {{ $attributes->merge(['class' => 'flex flex-col rounded-lg shadow-lg overflow-hidden']) }}>
    <div class="flex-shrink-0">
        <a href="{{ route('post.show', $post) }}">
            <img class="h-48 w-full object-cover"
                 src="{{ \Illuminate\Support\Str::contains($post->image, '://') ? $post->image : asset('storage/' . $post->image) }}"
                 alt="">
        </a>
    </div>
    <div class="flex-1 bg-white p-6 flex flex-col justify-between">
        <div class="flex-1">
            <p class="text-sm font-medium text-indigo-600">
                <a href="#" class="hover:underline">
                    Article
                </a>
            </p>
            <a href="{{ route('post.show', $post) }}" class="block mt-2">
                <p class="text-xl font-semibold text-gray-900">
                    {{ $post->title }}
                </p>
                <p class="mt-3 text-base text-gray-500">
                    {{ \Illuminate\Support\Str::limit($post->content, 20) }}
                </p>
            </a>
        </div>
        <div class="mt-6">
            <div>
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
