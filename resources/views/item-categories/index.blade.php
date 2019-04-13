@extends('layouts.dashboard')

@section('content')
    <category-item-view inline-template :user={{ auth()->id() }}>
        <div class="w-full lg:ml-376">
            <div class="flex px-three-five-px pt-12 pb-6">
                <main class="min-h-full w-full">
                    <div class="flex flex-col flex-1">
                        <div class="p-4 border-dashed border border-proton-grey-opacity-80 rounded text-solstice-blue group m-4 flex-1">
                            <h3 class="flex items-center justify-between flex-wrap mb-4 -mt-1 -mx-1 text-xs font-normal">
                                <span>
                                    <span class="inline-block mx-1 leading-loose cursor-pointer font-semibold text-eshangazi">
                                        Categories
                                    </span>

                                    <a href="#">
                                        <span class="inline-block mx-1 leading-loose cursor-pointer text-eshangazi-grey">
                                            View Items
                                        </span>
                                    </a>
                                </span>

                                <a href="#" @click="new_category">
                                    <span class="inline-block mx-1 leading-loose cursor-pointer text-eshangazi-grey">
                                        Create New
                                    </span>
                                </a>
                            </h3>

                            <div>
                                <form method="POST"  v-on:submit.prevent="store" v-if="creating" enctype="multipart/form-data">
                                    @csrf

                                    <div class="flex sm:flex-row flex-col -mx-2 border-red border-1">
                                        <input autocapitalize="none"
                                               autocomplete="off"
                                               autocorrect="off"
                                               class="flex-1 bg-moon-grey rounded mx-2 mb-4 py-4 px-6 text-telluric-blue shadow-none outline-none{{ $errors->has("name") ? " border border-red" : "" }}"
                                               id="name"
                                               placeholder="Name"
                                               spellcheck="false"
                                               type="text"
                                               name="name"
                                               v-model="category.name">
                                    </div>

                                    @if ($errors->has('name'))
                                        <div class="text-red mb-5">
                                            <p class="text-sm">{{ $errors->first('name') }}</p>
                                        </div>
                                    @endif

                                    <div class="flex sm:flex-row flex-col -mx-2">
                                        <textarea class="block w-full h-24 mb-8 bg-moon-grey rounded mx-2 mb-4 py-4 px-6 text-telluric-blue resize-none shadow-none outline-none leading-normal{{ $errors->has("description") ? " border border-red" : "" }}"
                                                  id="description"
                                                  placeholder="Category description goes here."
                                                  name="description"
                                                  required="required"
                                                  v-model="category.description"></textarea>
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
                                    <h4 class="subtitle">There are @{{ categories.length }} categories so far...</h4>

                                    <div>
                                        <ul class="list-reset" v-for="(category, index) in categories" :key="category.id" v-if="categories.length">
                                            <a :href="/item-categories/ + category.id" class="hover:no-underline text-grey-darkest">
                                                <li class="mb-4 pb-4 border-b">
                                                    <div class="flex">
                                                        <div class="flex items-center justify-center h-three-five w-three-five mr-4 flex-no-grow flex-no-shrink">
                                                            <img src="{{ asset('img/demo.jpg') }}" class="h-auto max-h-12 w-auto">
                                                        </div>

                                                        <div>
                                                            <h5 class="mb-2">
                                                                <span class="text-cosmos-black text-sm font-normal">
                                                                    @{{ category.name }}
                                                                </span>
                                                            </h5>

                                                            <p>
                                                                <span class="text-cosmos-black-opacity-70 text-xs ais-Snippet">
                                                                    @{{ category.description }}
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
                                            More categories
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
    </category-item-view>
@endsection