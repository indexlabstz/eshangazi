<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <title>eShangazi</title>

    <!-- Fonts -->
    <link href="https://unpkg.com/tailwindcss@^2/dist/tailwind.min.css" rel="stylesheet" type="text/css">

</head>
<body>

<div class="min-h-screen bg-white flex">
    <div class="flex-1 flex flex-col justify-center mx-auto w-full max-w-sm lg:w-96">
        <div class="flex flex-col items-center">
            <img class="h-32 w-auto" src="/svg/eShangazi.svg" alt="Wealth Fronts"/>

            <h2 class="mt-6 text-3xl font-extrabold text-gray-900">
                eShangazi
            </h2>

            <p class="mt-2 text-sm text-gray-600">
                Our new website is on its way.
            </p>
        </div>

        <div class="mt-8">
            <div>
                <div>
                    <p class="text-sm text-center font-medium text-gray-700">
                        Connect with us
                    </p>

                    <div class="mt-1 grid grid-cols-3 gap-3">
                        <div>
                            <a href="https://facebook.com/eshangazibot"
                               target="_blank"
                               class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <span class="sr-only">Follow us on Facebook</span>

                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                    <path fill-rule="evenodd"
                                          d="M20 10c0-5.523-4.477-10-10-10S0 4.477 0 10c0 4.991 3.657 9.128 8.438 9.878v-6.987h-2.54V10h2.54V7.797c0-2.506 1.492-3.89 3.777-3.89 1.094 0 2.238.195 2.238.195v2.46h-1.26c-1.243 0-1.63.771-1.63 1.562V10h2.773l-.443 2.89h-2.33v6.988C16.343 19.128 20 14.991 20 10z"
                                          clip-rule="evenodd"/>
                                </svg>
                            </a>
                        </div>

                        <div>
                            <a href="https://twitter.com/eshangazibot"
                               target="_blank"
                               class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <span class="sr-only">Follow us on Twitter</span>

                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 20 20">
                                    <path
                                            d="M6.29 18.251c7.547 0 11.675-6.253 11.675-11.675 0-.178 0-.355-.012-.53A8.348 8.348 0 0020 3.92a8.19 8.19 0 01-2.357.646 4.118 4.118 0 001.804-2.27 8.224 8.224 0 01-2.605.996 4.107 4.107 0 00-6.993 3.743 11.65 11.65 0 01-8.457-4.287 4.106 4.106 0 001.27 5.477A4.073 4.073 0 01.8 7.713v.052a4.105 4.105 0 003.292 4.022 4.095 4.095 0 01-1.853.07 4.108 4.108 0 003.834 2.85A8.233 8.233 0 010 16.407a11.616 11.616 0 006.29 1.84"/>
                                </svg>
                            </a>
                        </div>

                        <div>
                            <a href="https://instagram.com/eshangazibot"
                               target="_blank"
                               class="w-full inline-flex justify-center py-2 px-4 border border-gray-300 rounded-md shadow-sm bg-white text-sm font-medium text-gray-500 hover:bg-gray-50">
                                <span class="sr-only">Follow us on Instagram</span>

                                <svg class="w-5 h-5" aria-hidden="true" fill="currentColor" viewBox="0 0 512 512">
                                    <path d="M363.273 0H148.728C66.719 0 0 66.719 0 148.728v214.544C0 445.281 66.719 512 148.728 512h214.544C445.281 512 512 445.281 512 363.273V148.728C512 66.719 445.281 0 363.273 0zM472 363.272C472 423.225 423.225 472 363.273 472H148.728C88.775 472 40 423.225 40 363.273V148.728C40 88.775 88.775 40 148.728 40h214.544C423.225 40 472 88.775 472 148.728v214.544z"/>
                                    <path d="M256 118c-76.094 0-138 61.906-138 138s61.906 138 138 138 138-61.906 138-138-61.906-138-138-138zm0 236c-54.037 0-98-43.963-98-98s43.963-98 98-98 98 43.963 98 98-43.963 98-98 98z"/>
                                    <circle cx="396" cy="116" r="20"/>
                                </svg>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="mt-8">
            <div class="w-full border-t border-gray-300"/>
        </div>

        <div class="mt-8">
            <div class="flex">
                <div class="flex justify-center">
                    <div class="flex-shrink-0">
                        <PhoneIcon class="h-6 w-6 text-gray-400" aria-hidden="true"/>
                    </div>

                    <div class="ml-2 text-base text-gray-500">
                        <p>
                            +255 735 399 990
                        </p>
                    </div>
                </div>

                <div class="ml-3 flex justify-center">
                    <div class="flex-shrink-0">
                        <MailIcon class="h-6 w-6 text-gray-400" aria-hidden="true"/>
                    </div>

                    <div class="ml-2 text-base text-gray-500">
                        <p>
                            huduma@eshangazi.co.tz
                        </p>
                    </div>
                </div>
            </div>

            <div class="mt-6 text-center">
                <div class="text-base text-gray-500">
                    <p>
                        Dar Es Salaam - Tanzania
                    </p>
                </div>
            </div>
        </div>

        <div class="mt-8 mb-2 text-center">
            <p class="text-gray-400 text-base">
                <a href="https://t.me/eshangazibot"
                   class="w-full flex items-center justify-center px-8 py-3 border border-transparent text-base leading-6 font-medium rounded-md text-white bg-blue-600 hover:bg-blue-500 focus:outline-none focus:border-blue-700 focus:shadow-outline-blue transition duration-150 ease-in-out md:py-4 md:text-lg md:px-10" target="_blank">
                    Njoo Tutete
                </a>
            </p>
        </div>
    </div>
</div>
</body>
</html>
