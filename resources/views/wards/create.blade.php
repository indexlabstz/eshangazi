@extends('layouts.app')

@section('content')
<div class="card-body">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">
            New Ward
        </h1>

        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group">
                <a href="{{ route('index-ward') }}" class="btn btn-sm btn-outline-secondary">
                    Wards List
                </a>
            </div>
        </div>
    </div>    
    
    <form method="POST" action="{{ route('store-ward') }}">
        @csrf

        <div class="form-group">
            <label for="name">
                Name
            </label>

            <input id="name" name="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" 
                value="{{ old('name') }}" placeholder="Name" required autofocus>

            @if ($errors->has('name'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-row">
            <label for="district_id">
                District
            </label>

            <select id="district_id" name="district_id" class="form-control{{ $errors->has('district_id') ? ' is-invalid' : '' }}" required>
                <option selected>
                    Choose district...
                </option>

                @foreach($districts as $district)
                    <option value="{{ $district->id  }}">{{ $district->name }}</option>
                @endforeach
            </select>

            @if ($errors->has('district_id'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('district_id') }}</strong>
                </span>
            @endif
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