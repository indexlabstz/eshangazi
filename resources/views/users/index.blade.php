@extends('layouts.app')

@section('content')
<div class="card-body">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
        <h1 class="h2">
            Users
        </h1>

        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group">
                <a href="{{ route('create-user') }}" class="btn btn-sm btn-outline-secondary">
                    New User
                </a>
            </div>
        </div>
    </div>    

    <div class="table-responsive">
        @if($users->isEmpty())
            <p class="lead text-muted">
                No user created at the moment.
            </p>                

             <a href="{{ route('create-user') }}" class="btn btn-primary">
                Click here to add new User
            </a>      
        @else
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Email</th>
                        <th>Roles</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($users as $user)
                        <tr>
                            <td class="align-middle">
                                {{ $user->name }}
                            </td>

                            <td class="align-middle">
                                {{ $user->email }}
                            </td>

                            <td class="align-middle">
                                @if($user->roles)
                                    <ul>
                                    @foreach($user->roles as $role)
                                            <li>{{ $role->name }}</li>
                                        @endforeach
                                    </ul>
                                    @endif
                            </td>


                            <td class="text-center align-middle">
                                <form action="{{ route('delete-user', $user) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE')}}

                                    <div class="btn-group">
                                        <a href="{{ route('show-user', $user) }}" class="btn btn-sm btn-outline-secondary">
                                            Show
                                        </a>

                                        <a href="{{ route('edit-user', $user) }}" class="btn btn-sm btn-outline-secondary">
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

            {{ $users->links() }}
        @endif
    </div>
</div>
@endsection
