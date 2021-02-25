<div class="fixed z-60 transition duration-200 opacity-0 bottom-0 inset-x-0 pb-2 sm:pb-5 js-cookie-consent cookie-consent tran">
    <div class="max-w-7xl mx-auto px-2 sm:px-6 lg:px-8">
        <div class="p-2 rounded-lg bg-livinggod-green-100 shadow-lg sm:p-3">
            <div class="md:flex items-center justify-between flex-wrap">
                <div class="md:w-0 flex-1 flex items-center">
                    <p class="ml-3 font-medium text-white">
                        {!! trans('cookieConsent::texts.message') !!}
                    </p>
                </div>
                <div class="order-3 mt-8 flex-shrink-0 w-full sm:order-2 sm:mt-0 md:w-auto">
                    <button class="flex mx-auto items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-sm font-medium text-livinggod-green-100 bg-white hover:bg-gray-200 transition duration-100 focus:outline-none js-cookie-consent-agree cookie-consent__agree">
                        {{ trans('cookieConsent::texts.agree') }}
                    </button>
                </div>
            </div>
        </div>
    </div>
</div>

