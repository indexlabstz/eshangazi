@extends('layouts.app')

@section('content')
<div class="card-body">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">
            Partner Categories
        </h1>

        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group">
                <a href="{{ route('create-partner-category') }}" class="btn btn-sm btn-outline-secondary">
                    New Partner category
                </a>
            </div>
        </div>
    </div>
    @if($partner_categories->isEmpty())
        <p class="lead text-muted">
            No Partner Categories created at the moment.
        </p>
        <a href="{{ route('create-partner-category') }}" class="btn btn-primary">Click here to add new Partner Category </a>       
    @else   

    <div class="table-responsive">
        <table class="table table-striped table-sm">
            <thead>
                <tr>
                    <th>Name</th>
                    <th class="text-center">Actions</th>
                </tr>
            </thead>

            <tbody>
                @foreach($partner_categories as $partner_category)
                    <tr>
                        <td class="align-middle">
                            {{ $partner_category->name}}
                        </td>
                        
                        <td class="text-center align-middle">
                            <form action="{{ route('delete-partner-category', $partner_category) }}" method="POST">
                                {{ csrf_field() }}
                                {{ method_field('DELETE')}}

                                <div class="btn-group">
                                    <a href="{{ route('show-partner-category', $partner_category) }}" class="btn btn-sm btn-outline-secondary">
                                        Show
                                    </a>

                                    <a href="{{ route('edit-partner-category', $partner_category) }}" class="btn btn-sm btn-outline-secondary">
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

        {{ $partner_categories->links() }}
    </div>
    @endif
</div>
@endsection