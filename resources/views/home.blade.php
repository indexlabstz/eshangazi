@extends('layouts.app')

@section('content')
<div class="card-body">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
        <h1 class="h2">
            Dashboard
        </h1>

        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group">
                <a href="{{ route('index-member') }}" class="btn btn-sm btn-outline-secondary">
                    View Members
                </a>
            </div>
        </div>
    </div>    

    
</div>
@endsection