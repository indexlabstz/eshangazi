@extends('layouts.app')

@section('content')
<div class="card-body">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">
            Center Details
        </h1>

        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group">
                <a href="{{ route('index-center') }}" class="btn btn-sm btn-outline-secondary">
                    Centers List
                </a>
            </div>
        </div>
    </div>    

    <section class="jumbotron">
        <h1 class="jumbotron-heading">
            {{ $center->name }}
        </h1>

        <p class="lead text-muted">
            {{ $center->description }}
        </p>

        <p class="card-text">
            <small class="text-muted">
                Created by: 
                <a href="#">
                    {{ $center->creator->name }}  
                </a>

                {{ $center->created_at->toFormattedDateString() }}
            </small>
        </p>
    </section>

    <section class="relation">
        <ul class="nav nav-tabs" id="centerTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="services-tab" data-toggle="tab" href="#services" role="tab" aria-controls="services" aria-selected="true">
                    Services
                </a>
            </li>
        </ul>

        <div class="tab-content" id="centerTabRelation">
            <div class="tab-pane fade show active" id="services" role="tabpanel" aria-labelledby="services-tab">
            <div class="table-responsive">
                    @if($center->services->isEmpty())
                        <p class="lead text-muted">
                            No data to display at the moment.
                        </p>                        
                    @else
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Thumbnail</th>

                                    <th>Name</th>

                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($center->services as $service)
                                    <tr>
                                        <td class="align-middle">
                                            <img src="{{ $service->thumbnail ? (env('AWS_URL') . '/' . $service->thumbnail) : '/img/demo.jpg' }}" height="50" alt="{{ $service->title }}">
                                        </td>

                                        <td class="align-middle">
                                            {{ $service->name }}
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
                    @endif
                </div>
            </div>
        </div>
    </section>        
</div>
@endsection

@section('scripts')
    <script>
        $('#centerTab a').on('click', function (e) {
            e.preventDefault()
            $(this).tab('show')
        })
    </script>    
@endsection
