@extends('layouts.app')

@section('content')
    <div class="card-body">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">
                Role Details
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

        <section class="jumbotron">
            <p class="lead text-muted lead">
                Role Name: {{ $role->display_name }}
            </p>
        </section>

        <section class="relation">
            <ul class="nav nav-tabs" id="roleTab" role="tablist">
                <li class="nav-item">
                    <a class="nav-link active"
                       id="permission-tab"
                       data-toggle="tab"
                       href="#permission"
                       role="tab"
                       aria-controls="permission"
                       aria-selected="true">
                        Permissions
                    </a>
                </li>
            </ul>

            <div class="form-group row">
                @if($role->permissions)
                    @foreach($role->permissions as  $permission)
                        <div class="col-md-3">
                            {{  $permission->display_name }}
                        </div>
                    @endforeach
                @endif
            </div>
        </section>
    </div>
@endsection

@section('scripts')
    <script>
        $('#roleTab a').on('click', function (e) {
            e.preventDefault()
            $(this).tab('show')
        })
    </script>
@endsection
