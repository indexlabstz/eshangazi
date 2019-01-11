@extends('layouts.app')

@section('content')
<div class="card-body">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">
            Editing Partner
        </h1>

        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group">
                <a href="{{ route('index-partner') }}" class="btn btn-sm btn-outline-secondary">
                    Partners List
                </a>
            </div>
        </div>
    </div>    
    
    <form method="POST" action="{{ route('update-partner', $partner) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="name">
                    Name
                </label>

                <input id="name" type="text" class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}" name="name" value="{{ $partner->name }}" required autofocus>

                @if ($errors->has('name'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('name') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group col-md-6">
                <label for="partner_category_id">Category</label>

                <select id="partner_category_id" type="text" class="form-control{{ $errors->has('partner_category_id') ? ' is-invalid' : '' }}" name="partner_category_id" required>
                    <option value="">Choose Category...</option>

                    @foreach($partner_categories as $partner_category)
                        <option value="{{ $partner_category->id }}" {{ $partner->partner_category_id == $partner_category->id ? "selected":"" }}>
                            {{ $partner_category->name }}
                        </option>
                    @endforeach
                </select>

                @if ($errors->has('partner_category_id'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('partner_category_id') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="form-group">
            <label for="bio">Bio</label>

            <textarea id="bio" class="form-control{{ $errors->has('bio') ? ' is-invalid' : '' }}" name="bio" required>{{ $partner->bio }}</textarea>
            
            @if ($errors->has('bio'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('bio') }}</strong>
                </span>
            @endif
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="phone">Phone</label>
                
                <input id="phone" type="text" class="form-control{{ $errors->has('phone') ? ' is-invalid' : '' }}" name="phone" value="{{ $partner->phone }}" required>

                @if ($errors->has('phone'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('phone') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group col-md-6">
                <label for="email">Email</label>

                <input id="email" type="text" class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}" name="email" value="{{ $partner->email }}" required>

                @if ($errors->has('email'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('email') }}</strong>
                    </span>
                @endif
            </div> 
        </div>
        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="district_id">District</label>

                <select id="district_id" type="text" class="form-control{{ $errors->has('district_id') ? ' is-invalid' : '' }}" name="district_id" required>
                    <option value="">Choose District...</option>

                    @foreach($districts as $district)
                        <option value="{{ $district->id }}" {{ $partner->district_id == $district->id ? "selected":"" }}>
                            {{ $district->name }}
                        </option>
                    @endforeach
                </select>

                @if ($errors->has('district_id'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('district_id') }}</strong>
                    </span>
                @endif
            </div>
            <div class="form-group col-md-6">
                <label for="address">Address</label>

                <textarea id="address" class="form-control{{ $errors->has('address') ? ' is-invalid' : '' }}" name="address" required>{{ $partner->address }}</textarea>
                    
                @if ($errors->has('address'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('address') }}</strong>
                    </span>
                @endif
            </div>
        </div>
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mt-3 border-top">
            <h1 class="h2">
                &nbsp;
            </h1>

            <div class="btn-toolbar mb-2 mb-md-0">
                <button type="submit" class="btn btn-primary mt-3">Update</button>
            </div>
        </div> 
    </form>
</div>
@endsection
