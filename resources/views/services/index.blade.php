@extends('layouts.app')

@section('content')
<div class="card-body">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
        <h1 class="h2">
            Services
        </h1>

        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group">
                <a href="{{ route('create-service') }}" class="btn btn-sm btn-outline-secondary">
                    New Service
                </a>
            </div>
        </div>
    </div>    

    <div class="table-responsive">
        @if($services->isEmpty())
            <p class="lead text-muted">
                No data to display at the moment.
            </p>                   

            <a href="{{ route('create-service') }}" class="btn btn-primary">
                Click here to add new Center
            </a>                     
        @else
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>Thumbnail</th>

                        <th>Name</th>

                        <th>Center</th>

                        <th class="text-center">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($services as $service)
                        <tr>
                            <td class="align-middle">
                                <img src="{{ $service->thumbnail ? (env('AWS_URL') . '/' . $service->thumbnail) : '/img/demo.jpg' }}" height="50" alt="{{ $service->name }}">
                            </td>

                            <td class="align-middle">
                                {{ $service->name }}
                            </td>

                            <td class="align-middle">
                                {{ $service->center->name }}
                            </td>
                            
                            <td class="text-center align-middle">
                                <form action="{{ route('delete-service', $service) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE')}}

                                    <div class="btn-group">
                                        <a href="{{ route('show-service', $service) }}" class="btn btn-sm btn-outline-secondary">
                                            Show
                                        </a>

                                        <a href="{{ route('edit-service', $service) }}" class="btn btn-sm btn-outline-secondary">
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

            {{ $services->links() }}
        @endif
    </div>
</div>
@endsection