@extends('layouts.app')

@section('content')
<div class="card-body">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">
            Partners
        </h1>

        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group">
                <a href="{{ route('create-partner') }}" class="btn btn-sm btn-outline-secondary">
                    New Partner
                </a>
            </div>
        </div>
    </div>    

    @if($partners->isEmpty())
        <p class="lead text-muted">
            No Partner created at the moment.
        </p>
        <a href="{{ route('create-partner') }}" class="btn btn-primary">Click here to add new Partner</a>       
    @else 
    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Category</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($partners as $partner)
                    <tr>
                        <td class="align-middle">
                            {{ $partner->name}}
                        </td>
                        <td class="align-middle">
                            {{ $partner->email}}
                        </td>
                        <td class="align-middle">
                            {{ $partner->phone}}
                        </td>
                        <td class="align-middle">
                            {{ $partner->category->name }}
                        </td>
                        <td class="text-center align-middle">
                            <form action="{{ route('delete-partner', $partner) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE')}}

                                <div class="btn-group">
                                    <a href="{{ route('show-partner', $partner) }}" class="btn btn-sm btn-outline-secondary">
                                        Show
                                    </a>

                                    <a href="{{ route('edit-partner', $partner) }}" class="btn btn-sm btn-outline-secondary">
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

        {{ $partners->links() }}
    </div>
    @endif
</div>
@endsection