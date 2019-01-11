@extends('layouts.app')

@section('content')
<div class="card-body">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">
            User Details
        </h1>

        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group">
                <a href="{{ route('index-user') }}" class="btn btn-sm btn-outline-secondary">
                    Users List
                </a>
            </div>
        </div>
    </div>    

    <section class="jumbotron">
        <h1 class="jumbotron-heading">
            {{ $user->name }}
        </h1>

        <p class="lead text-muted">
            Email: {{ $user->email }}
        </p>        

        <p class="card-text">
            <small class="text-muted">
                Created on:
                {{ $user->created_at->toFormattedDateString() }}
            </small>
        </p>
    </section>

    <section class="relation">
        <ul class="nav nav-tabs" id="roleTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="role-tab" data-toggle="tab" href="#role" role="tab" aria-controls="role" aria-selected="true">
                    Roles
                </a>
            </li>

        </ul>

        <div class="tab-content" id="roleTabRelation">
            <div class="tab-pane fade show active" id="region" role="tabpanel" aria-labelledby="region-tab">
                <div class="table-responsive mt-2">
                    @if($user->roles->isEmpty())
                        <p class="lead text-muted">
                            User is not assigned to any role at the moment.
                        </p>                        
                    @else

                                @foreach($user->roles as $role)
                                   <ul>
                                       <li>{{ $role->name }}</li>
                                   </ul>
                                @endforeach

                    @endif
                </div>
            </div>
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
