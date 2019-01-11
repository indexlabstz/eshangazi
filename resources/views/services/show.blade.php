@extends('layouts.app')

@section('content')
<div class="card-body">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">
            Service Details
        </h1>

        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group">
                <a href="{{ route('index-service') }}" class="btn btn-sm btn-outline-secondary">
                    Services List
                </a>
            </div>
        </div>
    </div>    

    <section class="jumbotron">
        <h1 class="jumbotron-heading">
            {{ $service->name }}
        </h1>

        <p class="lead text-muted">
            {{ $service->description }}
        </p>

        <p class="card-text">
            <small class="text-muted">
                Created by: 
                <a href="#">
                    {{ $service->creator->name }}  
                </a>

                {{ $service->created_at->toFormattedDateString() }}
            </small>
        </p>
    </section>      
</div>
@endsection
