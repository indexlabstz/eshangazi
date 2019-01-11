@extends('layouts.app')

@section('content')
<div class="card-body">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">
            Partner Details
        </h1>

        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group">
                <a href="{{ route('index-partner') }}" class="btn btn-sm btn-outline-secondary">
                    Partner List
                </a>
            </div>
        </div>
    </div>    

    <section class="jumbotron">
        <h1 class="jumbotron-heading">
            {{ $partner->name }}
        </h1>

        <p class="lead text-muted">
            {{ $partner->bio }}
        </p>
        <p class="card-text">
            <small class="text-muted">
                Created by: 
                <a href="#" class="">
                    {{$partner->creator->name}}
                </a> 
                on 
                {{$partner->created_at->toFormattedDateString()}}
            </small></p>
    </section>
    
    <section class="relation">
        <ul class="nav nav-tabs" id="partnerTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="partners-tab" data-toggle="tab" href="#partners" role="tab" aria-controls="partners" aria-selected="true">
                    Payments
                </a>
            </li>
        </ul>
        <div class="tab-content" id="partnersTabRelation">
        <div class="tab-pane fade show active" id="partners" role="tabpanel" aria-labelledby="partners-tab">
            payments
        </div>
        </div>
    </section>
</div>
@endsection

@section('scripts')
    <script>
        $('#partnerTab a').on('click', function (e) {
            e.preventDefault()
            $(this).tab('show')
        })
    </script>    
@endsection
