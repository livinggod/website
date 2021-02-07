<div {{ $attributes->merge(['class' => 'md:flex md:flex-col md:rounded-lg md:shadow-lg md:overflow-hidden']) }}>
    <div class="hidden md:block flex-shrink-0">
        <a href="{{ route('articles.show', $post) }}">
            <img class="h-48 w-full object-cover"
                 src="{{ asset('storage/' . $post->image) }}"
                 alt="">
        </a>
    </div>
    <div class="flex-1 bg-white p-6">
        <div class="flex-1">
            <div class="flex justify-between">
                <div>
                    <p class="text-xs md:text-sm font-medium text-indigo-600">
                        <a href="#" class="hover:underline">
                            Article
                        </a>
                    </p>
                    <a href="{{ route('articles.show', $post) }}" class="block mt-2 mr-4">
                        <p class="text-md md:text-xl font-semibold text-gray-900">
                            {{ $post->title }}
                        </p>
                        <p class="hidden md:block mt-3 text-base text-gray-500">
                            {{ \Illuminate\Support\Str::limit($post->content, 20) }}
                        </p>
                    </a>
                </div>
                <img class="md:hidden h-20 w-20 object-cover"
                     src="{{ asset('storage/' . $post->image) }}"
                     alt="">
            </div>
        </div>
        <div class="mt-6 flex">
            <img class="hidden md:block w-8 h-8 md:w-10 md:h-10 object-cover rounded-full"
                 src="https://images.unsplash.com/photo-1604176736699-622601f98c9c?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1234&q=80"
                 alt="">
            <div class="md:ml-4">
                <p class="text-xs md:text-sm font-medium text-gray-900">
                    <a href="#" class="hover:underline">
                        {{ $post->user->name }}
                    </a>
                </p>
                <div class="flex space-x-1 text-xs md:text-sm text-gray-500">
                    <time datetime="{{ \Illuminate\Support\Carbon::parse($post->publish_at)->format('Y-m-d') ?? '' }}">
                        {{ \Illuminate\Support\Carbon::parse($post->publish_at)->format('F jS Y') ?? '' }}
                    </time>
                </div>
            </div>
        </div>
    </div>
</div>
