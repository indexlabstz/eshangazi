@extends('layouts.dashboard')

@section('content')
    <div class="w-full lg:ml-376">
        <div class="pt-16 bg-gradient-white-moon-grey">
            <div class="relative px-three-five-px pt-8 pb-five-px sm:pb-three-five-px md:pb-five-px">
                <div class="absolute pin bg-no-repeat bg-right-bottom bg-height-fit sm:opacity-100 opacity-50 z-0"
                     style="background-image:url(/svg/intro-bg.svg)"></div>

                <div class="relative z-10 flex justify-between max-w-728 w-full">
                    <div class="max-w-336 w-full mr-8">
                        <h1 class="text-5xl sm:text-3xl md:text-4xl font-semibold leading-tall md:mb-10 mb-6">
                            Members
                        </h1>

                        <h2 class="text-3xl sm:text-xl md:text-2xl font-semibold mb-2">
                            Goals of eShangazi
                        </h2>

                        <p class="text-solstice-blue-opacity-60 mb-6 leading-normal">
                            Membeers are users of eShangazi bot, they come from different channels and you can send a message direct from here to a selected member.</p>

                        <div class="flex -m-1 xl:flex-row flex-col">
                            <a class="inline-block btn-skeuomorphic btn-skeuomorphic-blue hover:no-underline  sm:py-2 py-4 px-6 m-1 text-center text-sm whitespace-no-wrap"
                               href="https://dialogflow.com" target="_blank">
                                <div class="flex items-center justify-center">
                            <span class="flex items-center h-4 w-auto mr-2 py-two-px flex-no-grow flex-no-shrink fill-current">
                              <svg class="block h-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 6 12">
                                  <path d="M5.83,5.29A.23.23,0,0,1,6,5.6s0,0,0,.05L2.3,11.88a.25.25,0,0,1-.47-.16l.54-4.24L.17,6.72A.26.26,0,0,1,0,6.4s0,0,0-.05L3.7.13a.25.25,0,0,1,.47.15L3.63,4.52Z"></path>
                              </svg>
                            </span>

                                    <span class="inline-block pt-1 pb-two-px"> Go to Dialogflow</span>
                                </div>
                            </a>

                            <a class="inline-block btn-skeuomorphic hover:no-underline sm:py-2 py-4 px-6 m-1 text-center whitespace-no-wrap text-sm"
                               href="m.me/eshangazibot" target="_blank"
                               rel="nofollow"
                               target="_blank">
                                <div class="flex items-center justify-center">
                                <span class="flex items-center h-4 w-auto mr-2 py-two-px flex-no-grow flex-no-shrink fill-current">
                                    <svg class="block h-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 8 10">
                                        <polygon points="0 0 0 10 8 5 0 0"></polygon>
                                    </svg>
                                </span>

                                    <span class="inline-block pt-1 pb-two-px"> View on Messenger </span>
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
                                    Members
                                </span>

                                <a href="#">
                                    <span class="inline-block mx-1 leading-loose cursor-pointer text-eshangazi-grey">
                                        View Items
                                    </span>
                                </a>
                            </span>
                        </h3>

                        <div>
                            <div class="">
                                <h4 class="subtitle">There are {{ $members->count() }} members so far...</h4>

                                <div>
                                    @if($members->isEmpty())
                                        <span class="text-cosmos-black text-sm font-normal">
                                            No data to display at the moment.
                                        </span>
                                    @else
                                        <ul class="list-reset">
                                            @foreach($members as $member)
                                                <a href="{{ route('show-item', $member) }}" class="hover:no-underline text-grey-darkest">
                                                    <li class="mb-4 pb-4 border-b">
                                                        <div>
                                                            <div>
                                                                <div class="flex">
                                                                    <div class="flex items-center justify-center h-three-five w-three-five mr-4 flex-no-grow flex-no-shrink">
                                                                        <img src="{{ $member->avatar ? $member->avatar : '/img/demo.png' }}" class="h-auto max-h-12 w-auto" alt="{{ $member->name }}">
                                                                    </div>

                                                                    <div>
                                                                        <h5 class="mb-2">
                                                                            <span class="text-cosmos-black text-sm font-normal">
                                                                                {{ $member->name }} from @if(is_null($member->platform_id)) Unknown @else {{ $member->platform->name }} @endif
                                                                            </span>
                                                                        </h5>

                                                                        <p>
                                                                            <span class="text-cosmos-black-opacity-70 text-xs ais-Snippet">
                                                                                {{ $member->name }}  has made 5 Conversations so far with eShangazi.
                                                                                @if(! is_null($member->platform_id))
                                                                                    You can simply <a href="{{ route('createmessage-member', $member) }}">send a message</a>  to {{ $member->name }} here on Admin Panel.
                                                                                @endif
                                                                            </span>
                                                                        </p>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </li>
                                                </a>
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
                                        More members
                                    </span>
                                </span>
                            </h3>

                            <div>
                                <div class="">
                                    <div class="ais-Pagination">
                                        {{ $members->links() }}
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </main>
        </div>
    </div>
@endsection