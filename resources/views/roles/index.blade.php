@extends('layouts.app')

@section('content')
    <div class="card-body">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
            <h1 class="h2">
                Roles
            </h1>

            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group">
                    <a href="{{ route('create-role') }}"
                       class="btn btn-sm btn-outline-secondary">
                        New Role
                    </a>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            @if($roles->isEmpty())
                <p class="lead text-muted">
                    No role is created at the moment.
                </p>

                <a href="{{ route('create-role') }}"
                   class="btn btn-primary">
                    Click here to add new Role
                </a>
            @else
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>
                                Name
                            </th>

                            <th>
                                Description
                            </th>

                            <th class="text-center">
                                Actions
                            </th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($roles as $role)
                            <tr>
                                <td class="align-middle">
                                    {{ $role->display_name }}
                                </td>

                                <td class="align-middle">
                                    {{ $role->description }}
                                </td>


                                <td class="text-center align-middle">
                                    <form action="{{ route('delete-role', $role) }}"
                                          method="POST">
                                        {{ csrf_field() }}
                                        {{ method_field('DELETE')}}

                                        <div class="btn-group">
                                            <a href="{{ route('show-role', $role) }}"
                                               class="btn btn-sm btn-outline-secondary">
                                                Show
                                            </a>

                                            <a href="{{ route('edit-role', $role) }}"
                                               class="btn btn-sm btn-outline-secondary">
                                                Edit
                                            </a>

                                            <button type="submit" class="btn btn-sm btn-outline-secondary">Delete</button>
                                        </div>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $roles->links() }}
            @endif
        </div>
    </div>
@endsection
