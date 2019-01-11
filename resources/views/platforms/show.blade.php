@extends('layouts.app')

@section('content')
    <div class="card-body">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">
                Platform Details
            </h1>

            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group">
                    <a href="{{ route('index-platform') }}" class="btn btn-sm btn-outline-secondary">
                        Platforms List
                    </a>
                </div>
            </div>
        </div>

        <section class="jumbotron">
            <h1 class="jumbotron-heading">
                {{ $platform->name }} - {{ $platform->driver_class }}
            </h1>

            <p class="lead text-muted">
                {{ $platform->description }}
            </p>

            <p class="card-text">
                <small class="text-muted">
                    Created by:
                    <a href="#">
                        {{ $platform->creator->name }}
                    </a>

                    on
                    {{ $platform->created_at->toFormattedDateString() }}
                </small>
            </p>
        </section>
    </div>
@endsection