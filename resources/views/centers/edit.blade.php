@extends('layouts.app')

@section('content')
<div class="card-body">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">
            Edit Center
        </h1>

        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group">
                <a href="{{ route('index-center') }}" class="btn btn-sm btn-outline-secondary">
                    Centers List
                </a>
            </div>
        </div>
    </div>    
    
    <form method="POST" action="{{ route('update-center', $center) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <label for="name">
                Name
            </label>

            <input id="name" name="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" 
                value="{{ $center->name }}" placeholder="Name" required autofocus>

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
                row="3" required>{{ $center->description }}</textarea>

            @if ($errors->has('description'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="phone">
                    Phone
                </label>

                <input id="phone" name="phone" type="number" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" 
                    value="{{ $center->phone }}" placeholder="Phone Number" required>

                @if ($errors->has('phone'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group col-md-6">
                <label for="address">
                    Address
                </label>

                <textarea id="address" name="address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" 
                row="3" required>{{ $center->address }}</textarea>

                @if ($errors->has('address'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('address') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
            <label for="email">
                    Email
                </label>

                <input id="email" name="email" type="email" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" 
                    value="{{ $center->email }}" placeholder="Email Address" required>

                @if ($errors->has('email'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group col-md-6">
                <label for="website">
                    Website
                </label>

                <input id="website" name="website" type="url" class="form-control{{ $errors->has('website') ? ' is-invalid' : '' }}" 
                    value="{{ $center->website }}" placeholder="Website URL" required>

                @if ($errors->has('website'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('website') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="partner_id">
                    Partner
                </label>

                <select id="partner_id" name="partner_id" class="form-control{{ $errors->has('partner_id') ? ' is-invalid' : '' }}" required>
                    <option disabled>
                        Choose Partner...
                    </option>

                    @foreach($partners as $partner)
                        @if($partner->id == $center->partner->id)
                            <option value="{{ $partner->id  }}" selected>{{ $partner->name }}</option>
                        @else
                            <option value="{{ $partner->id  }}">{{ $partner->name }}</option>
                        @endif                        
                    @endforeach
                </select>

                @if ($errors->has('partner_id'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('partner_id') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group col-md-6">
                <label for="ward_id">
                    Ward
                </label>

                <select id="ward_id" name="ward_id" class="form-control{{ $errors->has('ward_id') ? ' is-invalid' : '' }}" required>
                    <option disabled>
                        Choose where Partner located...
                    </option>

                    @foreach($wards as $ward)
                        @if($ward->id == $center->ward->id)
                            <option value="{{ $ward->id  }}" selected>{{ $ward->name }}</option>
                        @else
                            <option value="{{ $ward->id  }}">{{ $ward->name }}</option>
                        @endif
                    @endforeach
                </select>

                @if ($errors->has('ward_id'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('ward_id') }}</strong>
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