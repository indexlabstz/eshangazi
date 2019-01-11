@extends('layouts.app')

@section('content')
<div class="card-body">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">
            District Details
        </h1>

        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group">
                <a href="{{ route('index-district') }}" class="btn btn-sm btn-outline-secondary">
                    Districts List
                </a>
            </div>
        </div>
    </div>

    <section class="jumbotron">
        <h1 class="jumbotron-heading">
            {{ $district->name }}
        </h1>

        <p class="lead text-muted">
            {{ $district->region->name }}
        </p>

        <p class="card-text">
            <small class="text-muted">
                Created by: 
                <a href="#">
                    {{ $district->creator->name }}  
                </a>

                on
                {{ $district->created_at->toFormattedDateString() }}
            </small>
        </p>
    </section>

    <section class="relation">
        <ul class="nav nav-tabs" id="districtTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="ward-tab" data-toggle="tab" href="#ward" role="tab" aria-controls="ward" aria-selected="true">
                    Wards
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" id="member-tab" data-toggle="tab" href="#member" role="tab" aria-controls="member" aria-selected="true">
                    Members
                </a>
            </li>
            
            <li class="nav-item">
                <a class="nav-link" id="partner-tab" data-toggle="tab" href="#partner" role="tab" aria-controls="partner" aria-selected="true">
                    Partners
                </a>
            </li>
        </ul>

        <div class="tab-content" id="districtTabRelation">
            <div class="tab-pane fade show active" id="ward" role="tabpanel" aria-labelledby="ward-tab">
                <div class="table-responsive mt-2">
                    @if($district->wards->isEmpty())
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
                                @foreach($district->wards as $ward)
                                    <tr>
                                        <td class="align-middle">
                                            {{ $ward->name }}
                                        </td>
                                        <td class="text-center align-middle">
                                            <form action="{{ route('delete-ward', $ward) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE')}}

                                                <div class="btn-group">
                                                    <a href="{{ route('show-ward', $ward) }}" class="btn btn-sm btn-outline-secondary">
                                                        Show
                                                    </a>

                                                    <a href="{{ route('edit-ward', $ward) }}" class="btn btn-sm btn-outline-secondary">
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

            <div class="tab-pane fade show" id="member" role="tabpanel" aria-labelledby="member-tab">
                <div class="table-responsive mt-2">
                    @if($district->members->isEmpty())
                        <p class="lead text-muted">
                            No data to display at the moment.
                        </p>                        
                    @else
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Profile</th>

                                    <th>Name</th>

                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($district->members as $member)
                                    <tr>                                    
                                        <td class="align-middle">
                                            <img src="{{ asset('img/logo.jpg') }}" height="50" alt="{{ $member->name }}">
                                        </td>

                                        <td class="align-middle">
                                            {{ $member->name }}
                                        </td>

                                        <td class="text-center align-middle">
                                            <form action="{{ route('delete-member', $member) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE')}}

                                                <div class="btn-group">
                                                    <a href="{{ route('show-member', $member) }}" class="btn btn-sm btn-outline-secondary">
                                                        Show
                                                    </a>

                                                    <a href="{{ route('edit-member', $member) }}" class="btn btn-sm btn-outline-secondary">
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

            <div class="tab-pane fade show" id="partner" role="tabpanel" aria-labelledby="partner-tab">
                <div class="table-responsive mt-2">
                    @if($district->partners->isEmpty())
                        <p class="lead text-muted">
                            No data to display at the moment.
                        </p>                        
                    @else
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Name</th>

                                    <th>Phone Number</th>

                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($district->partners as $partner)
                                    <tr>                                    
                                        <td class="align-middle">
                                            {{ $partner->name }}
                                        </td>

                                        <td class="align-middle">
                                            {{ $partner->phone }}
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
                    @endif
                </div>
            </div>
        </div>
    </section>        
</div>
@endsection

@section('scripts')
    <script>
        $('#districtTab a').on('click', function (e) {
            e.preventDefault()
            $(this).tab('show')
        })
    </script>    
@endsection