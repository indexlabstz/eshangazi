@extends('layouts.app')

@section('content')
<div class="card-body">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">
            Edit District
        </h1>

        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group">
                <a href="{{ route('index-district') }}" class="btn btn-sm btn-outline-secondary">
                    Districts List
                </a>
            </div>
        </div>
    </div>    
    
    <form method="POST" action="{{ route('update-district', $district) }}">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <label for="name">
                Name
            </label>

            <input id="name" name="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" 
                value="{{ $district->name }}" placeholder="Name" required autofocus>

            @if ($errors->has('name'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-row">
            <label for="region_id">
                Region
            </label>

            <select id="region_id" name="region_id" class="form-control{{ $errors->has('region_id') ? ' is-invalid' : '' }}" required>
                <option disabled>
                    Choose region...
                </option>

                @foreach($regions as $region)
                    @if($region->id == $district->region->id)
                        <option value="{{ $region->id   }}" selected>{{ $region->name }}</option>
                    @else
                        <option value="{{ $region->id   }}">{{ $region->name }}</option>
                    @endif                    
                @endforeach
            </select>

            @if ($errors->has('region_id'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('region_id') }}</strong>
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
