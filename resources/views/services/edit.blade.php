@extends('layouts.app')

@section('content')
<div class="card-body">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">
            Edit Service
        </h1>

        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group">
                <a href="{{ route('index-service') }}" class="btn btn-sm btn-outline-secondary">
                    Services List
                </a>
            </div>
        </div>
    </div>    
    
    <form method="POST" action="{{ route('update-service', $service) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <label for="name">
                Name
            </label>

            <input id="name" name="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" 
                value="{{ $service->name }}" placeholder="Name" required autofocus>

            @if ($errors->has('name'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('name') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <label for="description">
                Description
            </label>

            <textarea id="description" name="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" 
                row="3" required>{{ $service->description }}</textarea>

            @if ($errors->has('description'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <label for="center_id">
                Center
            </label>

            <select id="center_id" name="center_id" class="form-control{{ $errors->has('center_id') ? ' is-invalid' : '' }}" required>
                <option disabled>
                    Choose Center...
                </option>

                @foreach($centers as $center)
                    @if($center->id == $service->center->id)
                        <option value="{{ $center->id  }}" selected>{{ $center->name }}</option>
                    @else
                        <option value="{{ $center->id  }}">{{ $center->name }}</option>
                    @endif
                @endforeach
            </select>

            @if ($errors->has('center_id'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('center_id') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="thumbnail">Thumbnail</label>

                <input  id="thumbnail" name="thumbnail" type="file" class="form-control-file">
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