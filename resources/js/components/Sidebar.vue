<template>
    <aside class="fixed pin-t flex-no-shrink bg-x-gradient-moon-grey-proton-grey-80 leading-tight lg:w-376 lg:flex lg:flex-col z-30 h-screen w-full hidden"
           data-main-sidebar="">
        <div class="lg:block h-18 flex-no-grow flex-no-shrink hidden"></div>

        <div class="flex-grow w-inherit overflow-y-auto h-full">
            <div class="h-full"
                 data-sidebar-scroll="">
                <ul class="list-reset px-10 pt-12 pb-6">
                    <li class="mb-6">
                        <a href="/home"
                           class="text-nebula-blue flex items-center no-underline hover:text-nebula-blue text-sm"
                           data-sidebar-active="true">
                            <span class="flex w-4 h-4 mr-6 items-center justify-center fill-current">
                                <svg class="h-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 17">
                                    <path d="M16.5,17H10.28a.5.5,0,0,1-.5-.5V10.28a.5.5,0,0,1,.5-.5H16.5a.5.5,0,0,1,.5.5V16.5A.5.5,0,0,1,16.5,17Zm-5.72-1H16V10.78H10.78ZM6.72,17H.5a.5.5,0,0,1-.5-.5V10.28a.5.5,0,0,1,.5-.5H6.72a.5.5,0,0,1,.5.5V16.5A.5.5,0,0,1,6.72,17ZM1,16H6.22V10.78H1ZM16.5,7.22H10.28a.5.5,0,0,1-.5-.5V.5a.5.5,0,0,1,.5-.5H16.5a.5.5,0,0,1,.5.5V6.72A.5.5,0,0,1,16.5,7.22Zm-5.72-1H16V1H10.78Zm-4.06,1H.5a.5.5,0,0,1-.5-.5V.5A.5.5,0,0,1,.5,0H6.72a.5.5,0,0,1,.5.5V6.72A.5.5,0,0,1,6.72,7.22ZM1,6.22H6.22V1H1Z"></path>
                                </svg>
                            </span>
                            Dashboard
                        </a>
                    </li>

                    <li class="cursor-pointer mb-6 text-cosmos-black"
                        data-sidebar-active="">
                        <span class="flex items-center capitalize text-sm"
                              data-toggle-item="true"
                              @click="toggleFeatures">
                            <span class="flex w-4 h-4 mr-6 items-center justify-center fill-current">
                                <svg class="h-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 9.2 18.2">
                                    <path d="M8.88,7.93,5.61,6.79,6.45.54A.47.47,0,0,0,6.13,0a.46.46,0,0,0-.57.21L.06,9.58l0,.08a.48.48,0,0,0,.29.61l3.27,1.14-.84,6.25a.47.47,0,0,0,.32.51.41.41,0,0,0,.16,0A.47.47,0,0,0,3.64,18L9.13,8.62a.59.59,0,0,0,0-.08A.48.48,0,0,0,8.88,7.93Zm-4.33,3.2a.49.49,0,0,0-.32-.51L1.13,9.54l4.19-7L4.65,7.07A.49.49,0,0,0,5,7.58l3.1,1.08-4.19,7Z"></path>
                                </svg>
                            </span>

                            Features
                        </span>

                        <ul class="list-reset ml-10"
                            :class="{ 'hidden' : feature }">
                            <li class="mb-4 mt-4">
                                <a href="/items"
                                   class="hover:text-nebula-blue no-underline text-nova-grey"
                                   data-sidebar-active="false">
                                    Items
                                </a>
                            </li>

                            <li class="mb-4 mt-4">
                                <a href="/messages"
                                   class="hover:text-nebula-blue no-underline text-nova-grey"
                                   data-sidebar-active="false">
                                    Messages
                                </a>
                            </li>

                            <li class="mb-4 mt-4">
                                <a href="/questions"
                                   class="hover:text-nebula-blue no-underline text-nova-grey"
                                   data-sidebar-active="false">
                                    Questions & Answers
                                </a>
                            </li>

                            <li class="mb-4 mt-4">
                                <a href="/centers"
                                   class="hover:text-nebula-blue no-underline text-nova-grey"
                                   data-sidebar-active="false">
                                    Centers
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="cursor-pointer mb-6 text-cosmos-black"
                        data-sidebar-active="">
                        <span class="flex items-center capitalize text-sm"
                              data-toggle-item="true"
                              @click="toggleConversations">
                            <span class="flex w-4 h-4 mr-6 items-center justify-center fill-current">
                                <svg class="h-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 17 17">
                                    <path d="M8.5,17A.54.54,0,0,1,8.28,17l-8-4a.5.5,0,1,1,.44-.9L8.5,15.94l7.78-3.89a.5.5,0,0,1,.44.9l-8,4A.54.54,0,0,1,8.5,17Zm0-4A.54.54,0,0,1,8.28,13l-8-4a.5.5,0,1,1,.44-.9L8.5,11.94l7.78-3.89a.5.5,0,0,1,.44.9l-8,4A.54.54,0,0,1,8.5,13Zm0-4A.54.54,0,0,1,8.28,9l-8-4a.5.5,0,0,1,0-.9l8-4a.49.49,0,0,1,.44,0l8,4a.5.5,0,0,1,0,.9l-8,4A.54.54,0,0,1,8.5,9ZM1.62,4.5,8.5,7.94,15.38,4.5,8.5,1.06Z"></path>
                                </svg>
                            </span>

                            Conversation
                        </span>

                        <ul class="list-reset ml-10"
                            :class="{ 'hidden' : conversation }">
                            <li class="mb-4 mt-4">
                                <a href="/conversations/statistics"
                                   class="hover:text-nebula-blue no-underline text-nova-grey"
                                   data-sidebar-active="false">
                                    Conversation
                                </a>
                            </li>

                            <li class="mb-4 mt-4">
                                <a href="/feedback"
                                   class="hover:text-nebula-blue no-underline text-nova-grey"
                                   data-sidebar-active="false">
                                    Feedback
                                </a>
                            </li>

                            <li class="mb-4 mt-4">
                                <a href="/platforms"
                                   class="hover:text-nebula-blue no-underline text-nova-grey"
                                   data-sidebar-active="false">
                                    Platform
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="cursor-pointer mb-6 text-cosmos-black"
                        data-sidebar-active="">
                        <span class="flex items-center capitalize text-sm"
                              data-toggle-item="true"
                              @click="toggleBusiness">
                            <span class="flex w-4 h-4 mr-6 items-center justify-center fill-current">
                                <svg class="h-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 16.24 16">
                                    <path d="M8.11,16a7.37,7.37,0,0,1-1-.07,8.08,8.08,0,0,1-7-6.81A8,8,0,0,1,4.87.66a.5.5,0,0,1,.4.92A7,7,0,0,0,1.07,9a7.15,7.15,0,0,0,13.61,1.74.5.5,0,0,1,.65-.26.51.51,0,0,1,.27.66A8.17,8.17,0,0,1,8.11,16Z"></path><path d="M15.74,8.5H8.12a.5.5,0,0,1-.5-.5V.5A.47.47,0,0,1,8.13,0a8.15,8.15,0,0,1,5.73,2.34A7.91,7.91,0,0,1,16.24,8,.5.5,0,0,1,15.74,8.5Zm-7.12-1h6.6a6.93,6.93,0,0,0-2.06-4.45A7.12,7.12,0,0,0,8.62,1Z"></path>
                                </svg>
                            </span>

                            Business
                        </span>

                        <ul class="list-reset ml-10"
                            :class="{ 'hidden' : business }">
                            <li class="mb-4 mt-4">
                                <a href="/partners"
                                   class="hover:text-nebula-blue no-underline text-nova-grey"
                                   data-sidebar-active="false">
                                    Partners
                                </a>
                            </li>

                            <li class="mb-4 mt-4">
                                <a href="/ads"
                                   class="hover:text-nebula-blue no-underline text-nova-grey"
                                   data-sidebar-active="false">
                                    Ads
                                </a>
                            </li>

                            <li class="mb-4 mt-4">
                                <a href="#"
                                   class="hover:text-nebula-blue no-underline text-nova-grey"
                                   data-sidebar-active="false">
                                    Payments
                                </a>
                            </li>

                            <li class="mb-4 mt-4">
                                <a href="#"
                                   class="hover:text-nebula-blue no-underline text-nova-grey"
                                   data-sidebar-active="false">
                                    Charges
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="cursor-pointer mb-6 text-cosmos-black"
                        data-sidebar-active="">
                        <span class="flex items-center capitalize text-sm"
                              data-toggle-item="true"
                              @click="toggleLocations">
                            <span class="flex w-4 h-4 mr-6 items-center justify-center fill-current">
                                <svg xmlns="http://www.w3.org/2000/svg" viewBox="0 0 24 22" class="w-32 h-32 block fill-current">
                                    <path d="M13.29 19.16l-1.64-1-.44.67 1.64 1zm2-4.84v-.06q-1.16-1.95-2.18-4a.5.5 0 0 0-.45-.28H8.69zm8.3 5.45l-1.76-6.44-2.61 3.58zm-5.2-3.41l3.1-4.27-.49-1.72a.61.61 0 0 0-.57-.37.49.49 0 0 0-.44.28q-1 2-2.18 4a1.49 1.49 0 0 1-1.31.72 2.06 2.06 0 0 1-.26 0zM8 18.73l-6.16-4.07L0 21.37a.5.5 0 0 0 .37.63H5.5z"></path><path d="M20.35 22l-9.07-6-4.53 6zm-9.27-4.78a.51.51 0 0 1 .68-.15l2.5 1.5a.5.5 0 0 1 .17.68l-1 1.5a.49.49 0 0 1-.67.15l-2.5-1.5a.5.5 0 0 1-.17-.68zm12.86 4L6.87 10H4.15l18 12h1.35a.5.5 0 0 0 .5-.5.59.59 0 0 0 0-.13zM2.12 13.65l6.43 4.28 1.9-2.53L3 10.43zM16.5 0A4.5 4.5 0 0 0 12 4.5c0 2.28 3.65 8.55 4.07 9.25a.49.49 0 0 0 .68.18.39.39 0 0 0 .18-.18c.42-.7 4.07-7 4.07-9.25A4.51 4.51 0 0 0 16.5 0zm0 6A1.5 1.5 0 1 1 18 4.5 1.5 1.5 0 0 1 16.5 6z"></path>
                                </svg>
                            </span>

                            Locations
                        </span>

                        <ul class="list-reset ml-10"
                            :class="{ 'hidden' : location }">
                            <li class="mb-4 mt-4">
                                <a href="/countries"
                                   class="hover:text-nebula-blue no-underline text-nova-grey"
                                   data-sidebar-active="false">
                                    Countries
                                </a>
                            </li>

                            <li class="mb-4 mt-4">
                                <a href="/regions"
                                   class="hover:text-nebula-blue no-underline text-nova-grey"
                                   data-sidebar-active="false">
                                    Regions
                                </a>
                            </li>

                            <li class="mb-4 mt-4">
                                <a href="/districts"
                                   class="hover:text-nebula-blue no-underline text-nova-grey"
                                   data-sidebar-active="false">
                                    Districts
                                </a>
                            </li>

                            <li class="mb-4 mt-4">
                                <a href="/wards"
                                   class="hover:text-nebula-blue no-underline text-nova-grey"
                                   data-sidebar-active="false">
                                    Wards
                                </a>
                            </li>
                        </ul>
                    </li>

                    <li class="cursor-pointer mb-6 text-cosmos-black"
                        data-sidebar-active="">
                        <span class="flex items-center capitalize text-sm"
                              data-toggle-item="true"
                              @click="toggleSettings">
                            <span class="flex w-4 h-4 mr-6 items-center justify-center fill-current">
                                <svg class="h-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 17">
                                    <path d="M7,17A.54.54,0,0,1,6.78,17C6.5,16.81,0,13.55,0,8.5V2.9a.5.5,0,0,1,.33-.47L6.83,0a.5.5,0,0,1,.34,0l6.5,2.4A.5.5,0,0,1,14,2.9V8.5c0,5.05-6.5,8.31-6.78,8.45A.54.54,0,0,1,7,17ZM1,3.25V8.5c0,3.95,4.89,6.83,6,7.44,1.11-.61,6-3.49,6-7.44V3.25L7,1Z"></path>
                                </svg>
                            </span>

                            Settings
                        </span>

                        <ul class="list-reset ml-10"
                            :class="{ 'hidden' : setting }">
                            <li class="mb-4 mt-4">
                                <a href="/users"
                                   class="hover:text-nebula-blue no-underline text-nova-grey"
                                   data-sidebar-active="false">
                                    Users
                                </a>
                            </li>

                            <li class="mb-4 mt-4">
                                <a href="/roles"
                                   class="hover:text-nebula-blue no-underline text-nova-grey"
                                   data-sidebar-active="false">
                                    Roles
                                </a>
                            </li>

                            <li class="mb-4 mt-4">
                                <a href="#"
                                   class="hover:text-nebula-blue no-underline text-nova-grey"
                                   data-sidebar-active="false">
                                    Currencies
                                </a>
                            </li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>

        <div class="px-10">
            <div class="flex flex-wrap items-center lg:justify-between -mx-4 py-4 border-proton-grey-opacity-60 border-solid border-t">
                <a class="block mx-4 py-2 text-xs text-telluric-blue hover:text-solstice-blue no-underline transition-fast-out"
                   href="#"
                   target="_blank">
                    Messenger
                </a>

                <a class="block mx-4 py-2 text-xs text-telluric-blue hover:text-solstice-blue no-underline transition-fast-out"
                   href="#"
                   target="_blank">
                    Telegram
                </a>

                <a class="block mx-4 py-2 text-xs text-telluric-blue hover:text-solstice-blue no-underline transition-fast-out"
                   href="#"
                   rel="nofollow"
                   target="_blank">
                    Website
                </a>
            </div>
        </div>

        <button class="flex lg:hidden absolute items-center pin-t pin-r mt-12 mr-10 text-telluric-blue-opacity-80 hover:text-telluric-blue fill-current transition-fast-out focus:outline-none focus:shadow-outline"
                data-toggle-sidebar="">
                <span class="flex items-center h-4 w-4 mr-4 flex-no-grow flex-no-shrink">
                    <svg class="block h-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 14">
                        <path d="M8.41,7l5.3-5.29A1,1,0,1,0,12.29.29L7,5.59,1.71.29A1,1,0,0,0,.29,1.71L5.59,7,.29,12.29a1,1,0,0,0,0,1.42,1,1,0,0,0,1.42,0L7,8.41l5.29,5.3a1,1,0,0,0,1.42,0,1,1,0,0,0,0-1.42Z"></path>
                    </svg>
                </span>

            <span class="block flex-no-grow flex-no-shrink mt-2 font-sans-alt text-base leading-none"> Close </span>
        </button>
    </aside>
</template>

<script>
    export default {
        data() {
            return {
                feature: true,
                conversation: true,
                business: true,
                location: true,
                setting: true, 
            };
        },

        methods: {
            toggleFeatures() {

                if(this.feature === true)
                    return this.feature = false;
                else
                    return this.feature = true;
            },


            toggleConversations() {

                if(this.conversation === true)
                    return this.conversation = false;
                else
                    return this.conversation = true;
            },


            toggleBusiness() {

                if(this.business === true)
                    return this.business = false;
                else
                    return this.business = true;
            },


            toggleLocations() {

                if(this.location === true)
                    return this.location = false;
                else
                    return this.location = true;
            },


            toggleSettings() {

                if(this.setting === true)
                    return this.setting = false;
                else
                    return this.setting = true;
            }
        }
    }
</script>
