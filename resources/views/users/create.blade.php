@extends('layouts.app')

@section('content')
    <div class="card-body">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">
                Create User
            </h1>

            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group">
                    <a href="{{ route('index-user') }}"
                       class="btn btn-sm btn-outline-secondary">
                        Users List
                    </a>
                </div>
            </div>
        </div>

        <form method="POST"
              action="{{ route('store-user') }}">
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
                            <strong>
                                {{ $errors->first('name') }}
                            </strong>
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6">
                    <label for="email">
                        Email
                    </label>

                    <input id="email"
                           name="email"
                           type="text"
                           class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }}"
                           value="{{ old('email') }}"
                           placeholder="Email Address"
                           required>

                    @if ($errors->has('email'))
                        <span class="invalid-feedback">
                            <strong>
                                {{ $errors->first('email') }}
                            </strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="role">
                        Roles
                    </label>

                    <select id="role"
                            name="roles_ids[]"
                            type="text"
                            class="form-control{{ $errors->has('role') ? ' is-invalid' : '' }}"
                            multiple="multiple"
                            title="Roles"
                            required>
                        @foreach($roles as $role)
                            <option value="{{ $role->id }}">
                                {{ $role->display_name }}
                            </option>
                        @endforeach
                    </select>

                    @if ($errors->has('role'))
                        <span class="invalid-feedback">
                        <strong>
                            {{ $errors->first('role') }}
                        </strong>
                    </span>
                    @endif
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="password">
                        Password
                    </label>

                    <input id="password"
                           name="password"
                           type="password"
                           class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }}"
                           value="{{ old('password') }}"
                           placeholder="Password"
                           required
                           autofocus>

                    @if ($errors->has('password'))
                        <span class="invalid-feedback">
                            <strong>
                                {{ $errors->first('password') }}
                            </strong>
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6">
                    <label for="password-confirm">
                        Confirm Password
                    </label>

                    <input id="password-confirm"
                           name="password_confirmation"
                           type="password"
                           class="form-control{{ $errors->has('password-confirm') ? ' is-invalid' : '' }}"
                           value="{{ old('password-confirm') }}"
                           placeholder="Confirm Password"
                           required>

                    @if ($errors->has('password-confirm'))
                        <span class="invalid-feedback">
                            <strong>
                                {{ $errors->first('password-confirm') }}
                            </strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mt-3 border-top">
                <h1 class="h2">
                    &nbsp;
                </h1>

                <div class="btn-toolbar mb-2 mb-md-0">
                    <button type="submit"
                            class="btn btn-primary mt-3">
                        Save
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
