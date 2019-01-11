@extends('layouts.app')

@section('content')
<div class="card-body">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">
            Ward Details
        </h1>

        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group">
                <a href="{{ route('index-ward') }}" class="btn btn-sm btn-outline-secondary">
                    Wards List
                </a>
            </div>
        </div>
    </div>    

    <section class="jumbotron">
        <h1 class="jumbotron-heading">
            {{ $ward->name }}
        </h1>

        <p class="lead text-muted">
            {{ $ward->district->name }}
        </p>

        <p class="card-text">
            <small class="text-muted">
                Created by: 
                <a href="#">
                    {{ $ward->creator->name }}  
                </a>

                on
                {{ $ward->created_at->toFormattedDateString() }}
            </small>
        </p>
    </section>

    <section class="relation">
        <ul class="nav nav-tabs" id="wardTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="center-tab" data-toggle="tab" href="#center" role="tab" aria-controls="center" aria-selected="true">
                    Centers
                </a>
            </li>
        </ul>

        <div class="tab-content" id="wardTabRelation">
            <div class="tab-pane fade show active" id="center" role="tabpanel" aria-labelledby="center-tab">
                <div class="table-responsive mt-2">
                    @if($ward->centers->isEmpty())
                        <p class="lead text-muted">
                            No data to display at the moment.
                        </p>                        
                    @else
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Name</th>
                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($ward->centers as $center)
                                    <tr>
                                        <td class="align-middle">
                                            {{ $center->name }}
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
                    @endif
                </div>
            </div>
        </div>
    </section>       
</div>
@endsection

@section('scripts')
    <script>
        $('#wardTab a').on('click', function (e) {
            e.preventDefault()
            $(this).tab('show')
        })
    </script>    
@endsection