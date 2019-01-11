@extends('layouts.auth')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card card-default">
                <div class="card-body">
                    <form class="form-signin" method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="text-center mb-4">
                            <img class="mb-4" src="{{ asset('img/logo.png') }}" alt="{{ config('app.name') }}" height="100">

                            <h1 class="h3 mb-3 font-weight-normal">
                                {{ config('app.name') }}
                            </h1>

                            <p>
                                {{ \Illuminate\Foundation\Inspiring::quote() }}
                            </p>
                        </div>

                        <div class="form-label-group">
                            <input type="email" id="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" 
                                name="email" value="{{ old('email') }}" placeholder="E-Mail Address" required autofocus>
                            
                            <label for="email">E-Mail Address</label>

                            @if ($errors->has('email'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('email') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="form-label-group">
                            <input type="password" id="password" class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}" 
                                name="password" placeholder="Password" required>
                            
                            <label for="password">Password</label>

                            @if ($errors->has('password'))
                                <span class="invalid-feedback">
                                    <strong>{{ $errors->first('password') }}</strong>
                                </span>
                            @endif
                        </div>

                        <div class="checkbox mb-3">
                            <label>
                                <input type="checkbox" value="remember-me" {{ old('remember') ? 'checked' : '' }}> Remember me
                            </label>
                        </div>

                        <button class="btn btn-lg btn-primary btn-block" type="submit">
                            Sign in
                        </button>

                        <p class="mt-5 mb-3 text-muted text-center">&copy; Index Labs</p>
                    </form>
                </div>
            </div>
        </div>


        
    </div>
</div>
@endsection
