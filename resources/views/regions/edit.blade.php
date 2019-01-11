@extends('layouts.app')

@section('content')
<div class="card-body">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">
            Edit Region
        </h1>

        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group">
                <a href="{{ route('index-region') }}" class="btn btn-sm btn-outline-secondary">
                    Regions List
                </a>
            </div>
        </div>
    </div>    
    
    <form method="POST" action="{{ route('update-region', $region) }}">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <label for="name">
                Name
            </label>

            <input id="name" name="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" 
                value="{{ $region->name }}" placeholder="Name" required autofocus>

            @if ($errors->has('name'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-row">
            <label for="country_id">
                Country
            </label>

            <select id="country_id" name="country_id" class="form-control{{ $errors->has('country_id') ? ' is-invalid' : '' }}" required>
                <option disabled>
                    Choose country...
                </option>

                @foreach($countries as $country)
                    @if($country->id == $region->country->id)
                        <option value="{{ $country->id   }}" selected>{{ $country->name }}</option>
                    @else
                        <option value="{{ $country->id   }}">{{ $country->name }}</option>
                    @endif                    
                @endforeach
            </select>

            @if ($errors->has('country_id'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('country_id') }}</strong>
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
