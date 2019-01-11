@extends('layouts.app')

@section('content')
    <div class="card-body">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
            <h1 class="h2">
                Conversations
            </h1>

            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group">
                    <a href="{{ route('conv-statistics') }}" class="btn btn-sm btn-outline-secondary">
                        Statistics
                    </a>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            @if($conversations->isEmpty())
                <p class="lead text-muted">
                    No data to display at the moment.
                </p>
            @else
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Thumbnail</th>

                            <th>Name</th>

                            <th>Gender</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($conversations as $conversation)
                            <tr>
                                <td class="align-middle">
                                    <img
                                        src="{{ $conversation->member->avatar ?
                                            $conversation->member->avatar :
                                            '/img/logo.png' }}"
                                        height="50"
                                        alt="{{ $conversation->member->name }}"
                                    >
                                </td>

                                <td class="align-middle">
                                    {{ $conversation->member->name }}
                                </td>

                                <td class="align-middle text-capitalize">
                                    {{ $conversation->intent }}
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $conversations->links() }}
            @endif
        </div>
    </div>
@endsection