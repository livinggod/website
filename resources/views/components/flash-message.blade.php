<div x-data="{show: true}" class="fixed z-1000 right-0 mx-8">
    <div x-show="show" class="rounded-md bg-green-50 p-4"
         x-transition:enter="transition ease-in duration-300"
         x-transition:enter-start="transform translate-x-full"
         x-transition:enter-end="transform translate-x-0"
         x-transition:leave="transition ease-out duration-300"
         x-transition:leave-start="transform translate-x-0"
         x-transition:leave-end="transform translate-x-full">
        <div class="flex">
            <div class="flex-shrink-0">
                <!-- Heroicon name: solid/check-circle -->
                <svg class="h-5 w-5 text-green-400" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20" fill="currentColor" aria-hidden="true">
                    <path fill-rule="evenodd" d="M10 18a8 8 0 100-16 8 8 0 000 16zm3.707-9.293a1 1 0 00-1.414-1.414L9 10.586 7.707 9.293a1 1 0 00-1.414 1.414l2 2a1 1 0 001.414 0l4-4z" clip-rule="evenodd" />
                </svg>
            </div>
            <div class="ml-3">
                <div class="text-sm text-green-700">
                    <p>
                        {{ __(session('message')) }}
                    </p>
                </div>
                <div class="mt-4">
                    <div class="flex">
                        <button @click="show = false" class="ml-auto bg-green-50 px-2 py-1.5 rounded-md text-sm font-medium text-green-800 hover:bg-green-100 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-offset-green-50 focus:ring-green-600">
                            @lang('Dismiss')
                        </button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
