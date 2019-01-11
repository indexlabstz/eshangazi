@extends('layouts.app')

@section('content')
    <div class="card-body">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">
                New Role
            </h1>

            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group">
                    <a href="{{ route('index-role') }}"
                       class="btn btn-sm btn-outline-secondary">
                        Roles List
                    </a>
                </div>
            </div>
        </div>

        <form method="POST"
              action="{{ route('store-role') }}">
            @csrf

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="name">
                        Name
                    </label>

                    <input id="name"
                           name="name"
                           type="text"
                           class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                           value="{{ old('name') }}"
                           placeholder="Name"
                           required
                           autofocus>

                    @if ($errors->has('name'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6">
                    <label for="display_name">
                        Display Name
                    </label>

                    <input id="display_name"
                           name="display_name"
                           type="text"
                           class="form-control{{ $errors->has('display_name') ? ' is-invalid' : '' }}"
                           value="{{ old('display_name') }}"
                           placeholder="Display Name"
                           required>

                    @if ($errors->has('display_name'))
                        <span class="invalid-feedback">
                            <strong>
                                {{ $errors->first('display_name') }}
                            </strong>
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-12">
                    <label for="description">
                        Description
                    </label>

                    <textarea id="description"
                              name="description"
                              type="text"
                              class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                              placeholder="Description"
                              required>{{ old('description') }}</textarea>

                    @if ($errors->has('description'))
                        <span class="invalid-feedback">
                            <strong>
                                {{ $errors->first('description') }}
                            </strong>
                        </span>
                    @endif
                </div>
            </div>

            <h1 class="h2">
                &nbsp;Attach Permission(S).
            </h1>

            <div class="form-group row">
                @foreach($permissions as $permission)
                    <div class="col-md-3">
                        <input type="checkbox"
                               name="permissions_ids[]"
                               value="{{ $permission->id }}"
                               title="Permission">&nbsp;
                        {{ $permission->display_name }}
                    </div>
                @endforeach
            </div>

            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mt-3 border-top">
                <h1 class="h2">
                    &nbsp;
                </h1>

                <div class="btn-toolbar mb-2 mb-md-0">
                    <button type="submit"
                            class="btn btn-primary mt-3">
                        Submit
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection