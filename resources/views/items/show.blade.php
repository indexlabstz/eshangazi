@extends('layouts.dashboard')

@section('content')
    <item-view inline-template :item="{{ $item }}" :user={{ auth()->id() }}>
        <div class="w-full lg:ml-376">
            <div class="px-three-five-px pt-8 sm:pb-three-five-px flex justify-between">
                <div class="text-xs leading-tight">
                    <div class="font-sans-alt uppercase font-semibold tracking-wide">
                        Status <span class="text-eshangazi">Unpublished</span>
                    </div>
                </div>

                <div class="flex items-center uppercase font-semibold tracking-wide text-cosmos-black-opacity-30 text-xs leading-tight whitespace-no-wrap font-sans-alt">
                    <span class="block mr-1 w-4 h-4 fill-current">
                        <span class="block p-2">
                            <svg class="block h-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 22 22">
                                <path d="M11,22A11,11,0,1,1,22,11,11,11,0,0,1,11,22ZM11,2a9,9,0,1,0,9,9A9,9,0,0,0,11,2Z"></path>
                                <path d="M15,14a.93.93,0,0,1-.45-.11l-4-2A1,1,0,0,1,10,11V5a1,1,0,0,1,2,0v5.38l3.45,1.73a1,1,0,0,1,.44,1.34A1,1,0,0,1,15,14Z"></path>
                            </svg>
                            <img src="{{ asset('img/demo.jpg') }}" class="h-auto max-h-12 w-auto">
                        </span>
                    </span>
                    Jan. 14, 2019
                </div>
            </div>

            <div class="bg-gradient-white-moon-grey">
                <div class="relative px-three-five-px pb-five-px sm:pb-three-five-px md:pb-five-px">
                    <div class="absolute pin bg-no-repeat bg-right-bottom bg-height-fit sm:opacity-100 opacity-50 z-0"
                         style="background-image:url(/svg/intro-bg.svg)"></div>

                    <div class="relative z-10 flex justify-between max-w-728 w-full">
                        <div class="max-w-336 w-full mr-8">

                            <h2 class="text-3xl sm:text-xl md:text-2xl font-semibold mb-2">
                                {{ $item->title }}
                            </h2>

                            <p class="text-solstice-blue-opacity-60 mb-6 leading-normal">
                                {{ $item->description }}
                            </p>

                            <div class="flex -m-1 xl:flex-row flex-col">
                                <a class="inline-block btn-skeuomorphic btn-skeuomorphic-blue hover:no-underline  sm:py-2 py-4 px-6 m-1 text-center text-sm whitespace-no-wrap"
                                   @click="publish">
                                    <div class="flex items-center justify-center">
                                        <span class="flex items-center h-4 w-auto mr-2 py-two-px flex-no-grow flex-no-shrink fill-current">
                                            <svg class="block h-full" xmlns="http://www.w3.org/2000/svg"
                                                 viewBox="0 0 6 12">
                                                <path d="M5.83,5.29A.23.23,0,0,1,6,5.6s0,0,0,.05L2.3,11.88a.25.25,0,0,1-.47-.16l.54-4.24L.17,6.72A.26.26,0,0,1,0,6.4s0,0,0-.05L3.7.13a.25.25,0,0,1,.47.15L3.63,4.52Z"></path>
                                            </svg>
                                        </span>

                                        <span class="inline-block pt-1 pb-two-px"> Publish </span>
                                    </div>
                                </a>

                                <a class="inline-block btn-skeuomorphic hover:no-underline sm:py-2 py-4 px-6 m-1 text-center whitespace-no-wrap text-sm"
                                   href="m.me/eshangazibot" target="_blank"
                                   rel="nofollow"
                                   target="_blank">
                                    <div class="flex items-center justify-center">
                                        <span class="flex items-center h-4 w-auto mr-2 py-two-px flex-no-grow flex-no-shrink fill-current">
                                            <svg class="block h-full" xmlns="http://www.w3.org/2000/svg"
                                                 viewBox="0 0 8 10">
                                                <polygon points="0 0 0 10 8 5 0 0"></polygon>
                                            </svg>
                                        </span>

                                        <span class="inline-block pt-1 pb-two-px"> Attach Image </span>
                                    </div>
                                </a>
                            </div>
                        </div>

                        <div class="flex-no-grow flex-no-shrink sm:w-288 w-296 -mb-176 sm:block hidden">
                            <img src="{{ asset('img/demo.jpg') }}" class="w-auto">
                        </div>
                    </div>
                </div>
            </div>

            <div class="flex px-three-five-px pt-12 pb-6">
                <main class="min-h-full w-full">
                    <div class="flex flex-col flex-1">
                        <div class="p-4 border-dashed border border-proton-grey-opacity-80 rounded text-solstice-blue group m-4 flex-1">
                            <h3 class="flex items-center justify-between flex-wrap mb-4 -mt-1 -mx-1 text-xs font-normal">
                                <span>
                                    <span class="inline-block mx-1 leading-loose cursor-pointer font-semibold text-eshangazi">
                                        Item Details
                                    </span>

                                    <a href="#">
                                        <span class="inline-block mx-1 leading-loose cursor-pointer text-eshangazi-grey">
                                            View Items
                                        </span>
                                    </a>
                                </span>

                                <a href="#" @click="new_item">
                                    <span class="inline-block mx-1 leading-loose cursor-pointer text-eshangazi-grey">
                                        Create New
                                    </span>
                                </a>
                            </h3>

                            <div>
                                <form method="POST" v-on:submit.prevent="store" v-if="creating"
                                      enctype="multipart/form-data">
                                    @csrf

                                    <div class="flex sm:flex-row flex-col -mx-2 border-red border-1">
                                        <input autocapitalize="none"
                                               autocomplete="off"
                                               autocorrect="off"
                                               class="flex-1 bg-moon-grey rounded mx-2 mb-4 py-4 px-6 text-telluric-blue shadow-none outline-none{{ $errors->has("title") ? " border border-red" : "" }}"
                                               id="title"
                                               placeholder="Title"
                                               spellcheck="false"
                                               type="text"
                                               name="title"
                                               v-model="child.title">
                                    </div>

                                    @if ($errors->has('title'))
                                        <div class="text-red mb-5">
                                            <p class="text-sm">{{ $errors->first('title') }}</p>
                                        </div>
                                    @endif

                                    <div class="flex sm:flex-row flex-col -mx-2">
                                        <textarea
                                                class="block w-full h-24 mb-8 bg-moon-grey rounded mx-2 mb-4 py-4 px-6 text-telluric-blue resize-none shadow-none outline-none leading-normal{{ $errors->has("description") ? " border border-red" : "" }}"
                                                id="description"
                                                placeholder="Item description goes here."
                                                name="description"
                                                required="required"
                                                v-model="child.description"></textarea>
                                    </div>

                                    @if ($errors->has('description'))
                                        <div class="text-red mb-5">
                                            <p class="text-sm">{{ $errors->first('description') }}</p>
                                        </div>
                                    @endif

                                    <div class="flex justify-center mt-5">
                                        <div class="block h-px flex-grow bg-telluric-blue-opacity-10"></div>
                                    </div>

                                    <div class="flex justify-center mt-8">
                                        <button class="btn-skeuomorphic py-4 px-10 focus:outline-none focus:shadow-outline">
                                            Submit
                                        </button>
                                    </div>
                                </form>

                                <div class="">
                                    <h4 class="subtitle">There are @{{ items.length }} items so far...</h4>

                                    <div>
                                        <ul class="list-reset" v-for="(item, index) in items" :key="item.id"
                                            v-if="items.length">
                                            <a :href="/items/ + item.id" class="hover:no-underline text-grey-darkest">
                                                <li class="mb-4 pb-4 border-b">
                                                    <div class="flex">
                                                        <div class="flex items-center justify-center h-three-five w-three-five mr-4 flex-no-grow flex-no-shrink">
                                                            <img src="{{ asset('img/demo.jpg') }}"
                                                                 class="h-auto max-h-12 w-auto">
                                                        </div>

                                                        <div>
                                                            <h5 class="mb-2">
                                                            <span class="text-cosmos-black text-sm font-normal">
                                                                @{{ item.title }}
                                                            </span>
                                                            </h5>

                                                            <p>
                                                            <span class="text-cosmos-black-opacity-70 text-xs ais-Snippet">
                                                                @{{ item.description }}
                                                            </span>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </li>
                                            </a>
                                        </ul>

                                        <span class="text-cosmos-black text-sm font-normal" v-else>
                                            No data to display at the moment.
                                        </span>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="mx-3 flex sm:flex-row flex-col">
                            <div class="p-4 border-dashed border border-proton-grey-opacity-80 rounded text-solstice-blue group m-1 h-104 flex-1">
                                <h3 class="flex items-center justify-between flex-wrap mb-4 -mt-1 -mx-1 text-xs font-normal">
                                <span>
                                    <span class="inline-block mx-1 leading-loose text-eshangazi-grey">
                                        More items
                                    </span>
                                </span>
                                </h3>

                                <div>
                                    <div class="">
                                        <div class="ais-Pagination">
                                            <ul class="ais-Pagination-list">
                                                <li class="ais-Pagination-item ais-Pagination-item--previousPage ais-Pagination-item--disabled">
                                                    <span aria-label="Previous" class="ais-Pagination-link"> ‹ </span>
                                                </li>

                                                <li class="ais-Pagination-item ais-Pagination-item--selected">
                                                    <a href="#" class="ais-Pagination-link"> 1 </a>
                                                </li>

                                                <li class="ais-Pagination-item">
                                                    <a href="#" class="ais-Pagination-link"> 2 </a>
                                                </li>

                                                <li class="ais-Pagination-item">
                                                    <a href="#" class="ais-Pagination-link"> 3 </a>
                                                </li>

                                                <li class="ais-Pagination-item ais-Pagination-item--nextPage">
                                                    <a aria-label="Next" href="#" class="ais-Pagination-link">›</a>
                                                </li>
                                            </ul>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </main>
            </div>
        </div>
    </item-view>
@endsection