@extends('layouts.app')

@section('content')
  <div class="card-body">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
      <h1 class="h2">
        New Ad
      </h1>

      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group">
          <a href="{{ route('index-ad') }}" class="btn btn-sm btn-outline-secondary">
            Ads List
          </a>
        </div>
      </div>
    </div>

    <form method="POST" action="{{ route('store-ad') }}" enctype="multipart/form-data">
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
          <div class="form-group col-md-6">
            <label for="mode">
              Mode
            </label>

            <select id="mode" name="mode" class="form-control{{ $errors->has('mode') ? ' is-invalid' : '' }}" required>
              <option selected>
                Choose mode...
              </option>

              <option value="free">
                free
              </option>

              <option value="discount">
                discount
              </option>

              <option value="paid">
                paid
              </option>
            </select>

            @if ($errors->has('mode'))
              <span class="invalid-feedback">
                        <strong>{{ $errors->first('mode') }}</strong>
                    </span>
            @endif
        </div>
          <div class="form-group col-md-6">
            <label for="partner_id">
              Partner
            </label>

            <select id="partner_id" name="partner_id" class="form-control{{ $errors->has('partner_id') ? ' is-invalid' : '' }}" required>
              <option selected>
                Choose Partner...
              </option>
              @foreach($partners as $partner)
                <option value="{{ $partner->id }}">
                  {{ $partner->name }}
                </option>
              @endforeach
            </select>

            @if ($errors->has('partner_id'))
              <span class="invalid-feedback">
                        <strong>{{ $errors->first('partner_id') }}</strong>
                    </span>
            @endif
          </div>
        </div>



        <div class="form-row">
        <div class="form-group col-md-6">
          <label for="starts">
            Start Date
          </label>

          <input id="starts" name="starts" type="date" class="form-control{{ $errors->has('starts') ? ' is-invalid' : '' }}"
                 value="{{ old('starts') }}" placeholder="starts" required autofocus>

          @if ($errors->has('starts'))
            <span class="invalid-feedback">
                    <strong>{{ $errors->first('starts') }}</strong>
                </span>
          @endif
        </div>
          <div class="form-group col-md-6">
            <label for="ends">
              Ends Date
            </label>

            <input id="starts" name="ends" type="date" class="form-control{{ $errors->has('ends') ? ' is-invalid' : '' }}"
                   value="{{ old('ends') }}" placeholder="ends" required autofocus>

            @if ($errors->has('ends'))
              <span class="invalid-feedback">
                    <strong>{{ $errors->first('ends') }}</strong>
                </span>
            @endif
          </div>
        </div>

      <div class="form-row">
        <div class="form-group col-md-6">
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
