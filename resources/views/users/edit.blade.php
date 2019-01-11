@extends('layouts.app')

@section('content')
    <div class="card-body">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">
                Edit User
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
              action="{{ route('update-user', $user) }}">
            @csrf
            @method('PATCH')

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="name">
                        Name
                    </label>

                    <input id="name"
                           name="name"
                           type="text"
                           class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }}"
                           value="{{ $user->name }}"
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
                           value="{{ $user->email }}"
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

                <div class="form-group col-md-6">
                    <label for="description">
                        Roles
                    </label>

                    <select id="role"
                            name="roles_ids[]"
                            type="text"
                            class="form-control{{ $errors->has('role') ? ' is-invalid' : '' }}"
                            multiple="multiple">

                        <option value="">
                            --Select Role--
                        </option>

                        @foreach($roles as $role)
                            @if($user->roles)
                                @if(in_array($role->id,$roles_ids))
                                    @foreach($user->roles as $attachedRoles)
                                        @if($role->id == $attachedRoles->id)
                                            <option value="{{ $role->id }}"
                                                    selected="selected">
                                                {{ $role->name }}
                                            </option>
                                        @endif
                                    @endforeach
                                @else
                                    <option value="{{ $role->id }}">
                                        {{ $role->name }}
                                    </option>
                                @endif
                            @else
                                <option value="{{ $role->id }}">
                                    {{ $role->name }}
                                </option>
                            @endif
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

            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mt-3 border-top">
                <h1 class="h2">
                    &nbsp;
                </h1>

                <div class="btn-toolbar mb-2 mb-md-0">
                    <button type="submit"
                            class="btn btn-primary mt-3">
                        Update
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection
