<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        @include ('partials._meta')

        <title>
            {{ config('app.name') }}
        </title>

        <!-- Styles -->
        <link href="{{ asset('css/app.css') }}" rel="stylesheet">

        <!-- Fonts -->
        <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.5.0/css/all.css" integrity="sha384-B4dIYHKNBt8Bc12p+WXckhzcICo0wtJAoU8YZTY5qE0Id1GSseTk6S+L3BlXeVIU" crossorigin="anonymous">


        @yield('head')
    </head>

    <body class="onboarding">
        <div class="container">
            <div class="pt-8 mb-4">
                <div class="flex lg:justify-between lg:items-center">
                    <a href="{{ url('/') }}" class="flex items-center sm:mb-5">
                        <img class="h-10 w-10" src="{{ asset('svg/eShangazi.svg') }}" alt="{{ config('app.name') }}">

                        <span class="text-white font-light ml-5 text-2xl">{{ config('app.name') }}</span>
                    </a>

                    <div class="text-white font-thin">
                        @yield('auth-link')
                    </div>
                </div>
            </div>

            @yield('content')
        </div>
    </body>
</html>
