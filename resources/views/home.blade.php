@extends('layouts.dashboard')

@section('content')
  <div class="w-full lg:ml-376">
    <div class="pt-16 bg-gradient-white-moon-grey">
        <div class="relative px-three-five-px pt-8 pb-five-px sm:pb-three-five-px md:pb-five-px">
            <div class="absolute pin bg-no-repeat bg-right-bottom bg-height-fit sm:opacity-100 opacity-50 z-0"
             style="background-image:url(/svg/intro-bg.svg)"></div>

            <div class="relative z-10 flex justify-between w-full">
                <div class="mx-3 w-1/4 flex sm:flex-row flex-col">
                    <div class="p-4 shadow bg-white rounded text-solstice-blue group m-1 h-104 flex-1">
                        <h3 class="flex items-center justify-between flex-wrap mb-4 -mt-1 -mx-1 text-xs font-normal">
                            <span>
                                <span class="inline-block mx-1 leading-loose text-eshangazi-grey">
                                    Members created today
                                </span>
                            </span>
                        </h3>

                        <div class="ais-Pagination">
                            {{ $member_count }}
                        </div>
                    </div>
                </div>

                <div class="mx-3 w-1/4 flex sm:flex-row flex-col">
                    <div class="p-4 shadow bg-white rounded text-solstice-blue group m-1 h-104 flex-1">
                        <h3 class="flex items-center justify-between flex-wrap mb-4 -mt-1 -mx-1 text-xs font-normal">
                            <span>
                                <span class="inline-block mx-1 leading-loose text-eshangazi-grey">
                                    Conversations created today
                                </span>
                            </span>
                        </h3>

                        <div class="ais-Pagination">
                            {{ $conversations->count() }}
                        </div>
                    </div>
                </div>

                <div class="mx-3 w-1/4 flex sm:flex-row flex-col">
                    <div class="p-4 shadow bg-white rounded text-solstice-blue group m-1 h-104 flex-1">
                        <h3 class="flex items-center justify-between flex-wrap mb-4 -mt-1 -mx-1 text-xs font-normal">
                            <span>
                                <span class="inline-block mx-1 leading-loose text-eshangazi-grey">
                                    Items
                                </span>
                            </span>
                        </h3>

                        <div class="ais-Pagination">
                            {{ $item_count }}
                        </div>
                    </div>
                </div>

                <div class="mx-3 w-1/4 flex sm:flex-row flex-col">
                    <div class="p-4 shadow bg-white w-1/4 rounded text-solstice-blue group m-1 h-104 flex-1">
                        <h3 class="flex items-center justify-between flex-wrap mb-4 -mt-1 -mx-1 text-xs font-normal">
                            <span>
                                <span class="inline-block mx-1 leading-loose text-eshangazi-grey">
                                    Questions
                                </span>
                            </span>
                        </h3>

                        <div class="ais-Pagination">
                            {{ $question_count }}
                        </div>
                    </div>
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
                                Conversations
                            </span>
                        </span>
                    </h3>

                    <div>
                        <div class="">
                            <h4 class="subtitle">There are {{ $conversations->count() }} conversations so far...</h4>

                            <div>
                                @if($conversations->isEmpty())
                                    <span class="text-cosmos-black text-sm font-normal">
                                        No data to display at the moment.
                                    </span>
                                @else
                                    <ul class="list-reset">
                                        @foreach($conversations as $conversation)
                                            <li class="mb-4 pb-4 border-b">
                                                <div class="flex">
                                                    <div class="flex items-center justify-center h-three-five w-three-five mr-4 flex-no-grow flex-no-shrink">
                                                        <img src="{{ asset('img/demo.jpg') }}" class="h-auto max-h-12 w-auto">
                                                    </div>

                                                    <div>
                                                        <h5 class="mb-2">
                                                            <span class="text-cosmos-black text-sm font-normal">
                                                                {{ $conversation->hits }}
                                                            </span>
                                                        </h5>

                                                        <p>
                                                            <span class="text-cosmos-black-opacity-70 text-xs ais-Snippet">
                                                                {{ $conversation->intent }}
                                                            </span>
                                                        </p>
                                                    </div>
                                                </div>
                                            </li>
                                        @endforeach
                                    </ul>
                                @endif
                            </div>
                        </div>
                    </div>
                </div>

                <div class="mx-3 flex sm:flex-row flex-col">
                    <div class="p-4 border-dashed border border-proton-grey-opacity-80 rounded text-solstice-blue group m-1 h-104 flex-1">
                        <h3 class="flex items-center justify-between flex-wrap mb-4 -mt-1 -mx-1 text-xs font-normal">
                            <span>
                                <span class="inline-block mx-1 leading-loose text-eshangazi-grey">
                                    More Conversations
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
@endsection

{{-- @extends('layouts.dashboard')

@section('content')
    <div class="card-body">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
            <h1 class="h2">
                Dashboard
            </h1>

            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group">
                    <a href="{{ route('index-member') }}" class="btn btn-sm btn-outline-secondary">
                        View Members
                    </a>
                </div>
            </div>
        </div>
    </div>
@endsection --}}