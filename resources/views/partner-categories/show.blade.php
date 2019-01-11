@extends('layouts.app')

@section('content')
<div class="card-body">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">
            Partner Category Details
        </h1>

        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group">
                <a href="{{ route('index-partner-category') }}" class="btn btn-sm btn-outline-secondary">
                    Partner Category List
                </a>
            </div>
        </div>
    </div>    

    <section class="jumbotron">
        <h1 class="jumbotron-heading">
            {{ $partner_category->name }}
        </h1>

        <p class="lead text-muted">
            {{ $partner_category->description }}
        </p>
        <p class="card-text">
            <small class="text-muted">
                Created by: 
                <a href="#" class="">
                    {{$partner_category->creator->name}}
                </a> 
                on 
                {{$partner_category->created_at->toFormattedDateString()}}
            </small></p>
    </section>
    
    <section class="relation">
        <ul class="nav nav-tabs" id="partnerCategoryTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="partners-tab" data-toggle="tab" href="#partners" role="tab" aria-controls="partners" aria-selected="true">Partners</a>
            </li>
        </ul>
        <div class="tab-content" id="partnersTabRelation">
        <div class="tab-pane fade show active" id="partners" role="tabpanel" aria-labelledby="partners-tab">
            @if($partner_category->partners->isEmpty())
                <p class="lead text-muted mt-2">
                    No Partners Associeated with this category at the moment.
                </p>     
            @else   

            <div class="table-responsive mt-2">
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Phone</th>
                            <th>Adress</th>
                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($partner_category->partners as $partner)
                            <tr>
                                <td class="align-middle">
                                    {{ $partner->name}}
                                </td>
                                <td class="align-middle">
                                    {{ $partner->email }}
                                </td>
                                <td class="align-middle">
                                    {{ $partner->phone }}
                                </td>
                                <td class="align-middle">
                                    {{ $partner->address }}
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
            </div>
            @endif
        </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')
    <script>
        $('#partnerCategoryTab a').on('click', function (e) {
            e.preventDefault()
            $(this).tab('show')
        })
    </script>    
@endsection
