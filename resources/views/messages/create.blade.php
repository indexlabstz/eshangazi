@extends('layouts.app')

@section('content')
<div class="card-body">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">
            New Message
        </h1>

        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group">
                <a href="{{ route('index-message') }}" class="btn btn-sm btn-outline-secondary">
                    Messages List
                </a>
            </div>
        </div>
    </div>    
    
    <form method="POST" action="{{ route('store-message') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="title">
                Title
            </label>

            <input id="title" name="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" 
                value="{{ old('title') }}" placeholder="Title" required autofocus>

            @if ($errors->has('title'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <label for="description">Description</label>

            <textarea id="description" name="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" 
                row="3" required>{{ old('description') }}</textarea>

            @if ($errors->has('description'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="gender">
                    Gender
                </label>

                <select id="gender" name="gender" class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}" required>
                    <option selected>
                        Choose gender...
                    </option>

                    <option value="male">
                        Male
                    </option>

                    <option value="female">
                        Female
                    </option>

                    <option value="both">
                        Both
                    </option>
                </select>

                @if ($errors->has('gender'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('gender') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group col-md-6">
                <label for="minimum_age">
                    Age
                </label>

                <input id="minimum_age" name="minimum_age" type="number" class="form-control{{ $errors->has('minimum_age') ? ' is-invalid' : '' }}" 
                    value="{{ old('minimum_age') }}" placeholder="Minimum Age" required>

                @if ($errors->has('minimum_age'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('minimum_age') }}</strong>
                    </span>
                @endif
            </div>
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
