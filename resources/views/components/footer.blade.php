<footer class="bg-white" aria-labelledby="footerHeading">
    <h2 id="footerHeading" class="sr-only">Footer</h2>
    <div class="mx-auto py-12 px-4 sm:px-6 lg:py-16 lg:px-8">
        <div class="max-w-7xl mx-auto xl:grid xl:grid-cols-3 xl:gap-8">
            <div class="grid grid-cols-2 gap-8 xl:col-span-2">
                <div class="md:grid md:grid-cols-2 md:gap-8">
                    <x-footer.column title="test">
                        <x-footer.link class="" href="#">Testing</x-footer.link>
                        Lorem ipsum dolor sit amet, consectetur adipisicing elit. Dicta dignissimos earum voluptatibus? Illum, iure, quisquam. Cum doloremque labore officia suscipit.
                    </x-footer.column>
                </div>
                <div class="mt-12 md:mt-0">
                    <x-footer.column title="legal">
                        <x-footer.link class="" href="#">Testing</x-footer.link>
                    </x-footer.column>
                </div>
            </div>
            <div class="mt-8 xl:mt-0">
                <h3 class="text-sm font-semibold text-gray-400 tracking-wider uppercase">
                    Be the first to receive our content
                </h3>
                <form class="mt-4 sm:flex sm:max-w-md">
                    <label for="emailAddress" class="sr-only">Email address</label>
                    <input type="email" name="emailAddress" id="emailAddress" autocomplete="email" required
                           class="appearance-none min-w-0 w-full bg-white border border-gray-300 rounded-md shadow-sm py-2 px-4 text-base text-gray-900 placeholder-gray-500 focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:placeholder-gray-400"
                           placeholder="Enter your email">
                    <div class="mt-3 rounded-md sm:mt-0 sm:ml-3 sm:flex-shrink-0">
                        <button type="submit"
                                class="w-full bg-custom-green-100 flex items-center justify-center border border-transparent rounded-md py-2 px-4 text-base font-medium text-white focus:outline-none hover:bg-custom-green-200 focus:bg-custom-green-300">
                            Subscribe
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</footer>
