@extends('layouts.app')

@section('content')
<div class="card-body">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">
            Edit Country
        </h1>

        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group">
                <a href="{{ route('index-country') }}" class="btn btn-sm btn-outline-secondary">
                    Countries List
                </a>
            </div>
        </div>
    </div>    
    
    <form method="POST" action="{{ route('update-country', $country) }}">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <label for="name">
                Name
            </label>

            <input id="name" name="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" 
                value="{{ $country->name }}" placeholder="Name" required autofocus>

            @if ($errors->has('name'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="code">
                    Code
                </label>

                <input id="code" name="code" type="text" class="form-control{{ $errors->has('code') ? ' is-invalid' : '' }}" 
                    value="{{ $country->code }}" placeholder="Code" required>

                @if ($errors->has('code'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('code') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group col-md-6">
                <label for="iso">
                    ISO
                </label>

                <input id="iso" name="iso" type="text" class="form-control{{ $errors->has('iso') ? ' is-invalid' : '' }}" 
                    value="{{ $country->iso }}" placeholder="ISO" required autofocus>

                @if ($errors->has('iso'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('iso') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mt-3 border-top">
            <h1 class="h2">
                &nbsp;
            </h1>

            <div class="btn-toolbar mb-2 mb-md-0">
                <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </div>
        </div> 
    </form>
</div>
@endsection
