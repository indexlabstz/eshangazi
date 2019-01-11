@extends('layouts.app')

@section('content')
<div class="card-body">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">
            Region Details
        </h1>

        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group">
                <a href="{{ route('index-region') }}" class="btn btn-sm btn-outline-secondary">
                    Regions List
                </a>
            </div>
        </div>
    </div>    

    <section class="jumbotron">
        <h1 class="jumbotron-heading">
            {{ $region->name }}
        </h1>

        <p class="lead text-muted">
            {{ $region->country->name }}
        </p>

        <p class="card-text">
            <small class="text-muted">
                Created by: 
                <a href="#">
                    {{ $region->creator->name }}  
                </a>

                on
                {{ $region->created_at->toFormattedDateString() }}
            </small>
        </p>
    </section>

    <section class="relation">
        <ul class="nav nav-tabs" id="regionTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="district-tab" data-toggle="tab" href="#district" role="tab" aria-controls="district" aria-selected="true">
                    Districts
                </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" id="ads-tab" data-toggle="tab" href="#ads" role="tab" aria-controls="ads" aria-selected="true">
                    Adverts
                </a>
            </li>
        </ul>

        <div class="tab-content" id="regionTabRelation">
            <div class="tab-pane fade show active" id="district" role="tabpanel" aria-labelledby="district-tab">
                <div class="table-responsive mt-2">
                    @if($region->districts->isEmpty())
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
                                @foreach($region->districts as $district)
                                    <tr>
                                        <td class="align-middle">
                                            {{ $district->name }}
                                        </td>
                                        <td class="text-center align-middle">
                                            <form action="{{ route('delete-district', $district) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE')}}

                                                <div class="btn-group">
                                                    <a href="{{ route('show-district', $district) }}" class="btn btn-sm btn-outline-secondary">
                                                        Show
                                                    </a>

                                                    <a href="{{ route('edit-district', $district) }}" class="btn btn-sm btn-outline-secondary">
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

            <div class="tab-pane fade show" id="ads" role="tabpanel" aria-labelledby="ads-tab">
                <div class="table-responsive mt-2">
                    ...
                </div>
            </div>
        </div>
    </section>       
</div>
@endsection

@section('scripts')
    <script>
        $('#regionTab a').on('click', function (e) {
            e.preventDefault()
            $(this).tab('show')
        })
    </script>    
@endsection