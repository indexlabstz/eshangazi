@extends('layouts.app')

@section('content')
<div class="card-body">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
        <h1 class="h2">
            Centers
        </h1>

        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group">
                <a href="{{ route('create-center') }}" class="btn btn-sm btn-outline-secondary">
                    New Center
                </a>
            </div>
        </div>
    </div>    

    <div class="table-responsive">
        @if($centers->isEmpty())
            <p class="lead text-muted">
                No data to display at the moment.
            </p>                   

            <a href="{{ route('create-center') }}" class="btn btn-primary">
                Click here to add new Center
            </a>                     
        @else
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>Thumbnail</th>

                        <th>Name</th>

                        <th>Phone</th>

                        <th>Location</th>

                        <th class="text-center">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($centers as $center)
                        <tr>
                            <td class="align-middle">
                                <img src="{{ $center->thumbnail ? (env('AWS_URL') . '/' . $center->thumbnail) : '/img/demo.jpg' }}" height="50" alt="{{ $center->name }}">
                            </td>

                            <td class="align-middle">
                                {{ $center->name }}
                            </td>

                            <td class="align-middle">
                                {{ $center->phone }}
                            </td>

                            <td class="align-middle">
                                {{ $center->ward->name }}
                            </td>
                            
                            <td class="text-center align-middle">
                                <form action="{{ route('delete-center', $center) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE')}}

                                    <div class="btn-group">
                                        <a href="{{ route('show-center', $center) }}" class="btn btn-sm btn-outline-secondary">
                                            Show
                                        </a>

                                        <a href="{{ route('edit-center', $center) }}" class="btn btn-sm btn-outline-secondary">
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

            {{ $centers->links() }}
        @endif
    </div>
</div>
@endsection