@extends('layouts.app')

@section('content')
<div class="card-body">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">
            Country Details
        </h1>

        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group">
                <a href="{{ route('index-country') }}" class="btn btn-sm btn-outline-secondary">
                    Countries List
                </a>
            </div>
        </div>
    </div>    

    <section class="jumbotron">
        <h1 class="jumbotron-heading">
            {{ $country->name }}
        </h1>

        <p class="lead text-muted">
            Code: {{ $country->code }} ISO: {{ $country->iso }}
        </p>        

        <p class="card-text">
            <small class="text-muted">
                Created by: 
                <a href="#">
                    {{ $country->creator->name }}  
                </a>

                on
                {{ $country->created_at->toFormattedDateString() }}
            </small>
        </p>
    </section>

    <section class="relation">
        <ul class="nav nav-tabs" id="countryTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="region-tab" data-toggle="tab" href="#region" role="tab" aria-controls="region" aria-selected="true">
                    Regions
                </a>
            </li>
        </ul>

        <div class="tab-content" id="countryTabRelation">
            <div class="tab-pane fade show active" id="region" role="tabpanel" aria-labelledby="region-tab">
                <div class="table-responsive mt-2">
                    @if($country->regions->isEmpty())
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
                                @foreach($country->regions as $region)
                                    <tr>
                                        <td class="align-middle">
                                            {{ $region->name }}
                                        </td>
                                        <td class="text-center align-middle">
                                            <form action="{{ route('delete-region', $region) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE')}}

                                                <div class="btn-group">
                                                    <a href="{{ route('show-region', $region) }}" class="btn btn-sm btn-outline-secondary">
                                                        Show
                                                    </a>

                                                    <a href="{{ route('edit-region', $region) }}" class="btn btn-sm btn-outline-secondary">
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
        $('#countryTab a').on('click', function (e) {
            e.preventDefault()
            $(this).tab('show')
        })
    </script>    
@endsection
