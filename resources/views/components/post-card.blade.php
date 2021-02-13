<div {{ $attributes->merge(['class' => 'relative md:flex md:flex-col md:rounded-lg md:shadow-md md:overflow-hidden transition duration-300 md:hover:shadow-xl']) }}>
    <a class="absolute w-full h-full" href="{{ route('articles.show', $post) }}"></a>
    <div class="hidden md:block flex-shrink-0">
        <a href="{{ route('articles.show', $post) }}">
            <img class="h-48 w-full object-cover"
                 src="{{ asset('storage/' . $post->image) }}"
                 alt="">
        </a>
    </div>
    <div class="flex-1 bg-white p-4 md:p-6 flex flex-col justify-between">
        <div class="flex-1">
            <div class="flex justify-between">
                <div>
                    <p class="text-xs md:text-sm font-medium text-indigo-600">
                        <a href="#" class="relative z-10 hover:underline -ml-2 p-2 md:m-0 md:p-0">
                            {{ $post->category->name }}
                        </a>
                    </p>
                    <a href="{{ route('articles.show', $post) }}" class="block mt-2 mr-4">
                        <p class="text-md md:text-xl font-semibold text-gray-900">
                            {{ $post->title }}
                        </p>
                        <p class="hidden md:block text-md mt-2 text-gray-500">
                            {{ $post->description ?? '' }}
                        </p>
                        <p class="md:hidden text-sm text-gray-500">
                            {{ \Illuminate\Support\Str::limit($post->description, 20) ?? '' }}
                        </p>
                    </a>
                </div>
                <img class="md:hidden h-20 w-20 object-cover rounded-lg"
                     src="{{ asset('storage/' . $post->image) }}"
                     alt="">
            </div>
        </div>
        <div class="mt-4 md:mt-6 flex w-full">
            <a class="hidden md:block relative z-10" href="#">
                <img class="w-8 h-8 md:w-10 md:h-10 object-cover rounded-full"
                     src="https://images.unsplash.com/photo-1604176736699-622601f98c9c?ixid=MXwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHw%3D&ixlib=rb-1.2.1&auto=format&fit=crop&w=1234&q=80"
                     alt="">
            </a>

            <div class="flex md:block gap-2 md:ml-4">
                <p class="text-xs md:text-sm font-medium text-gray-900">
                    <a href="#" class="relative z-10 hover:underline w-6 text-wrap p-2 -mx-2">
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
