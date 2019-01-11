@extends('layouts.app')

@section('content')
    <div class="card-body">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
            <h1 class="h2">
                Feedback
            </h1>

            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group">

                </div>
            </div>
        </div>

        <div class="table-responsive">
            @if($feedbacks->isEmpty())
                <p class="lead text-muted">
                    No data to display at the moment.
                </p>
            @else
                <table class="table table-striped table-sm">
                    <thead>
                        <tr>
                            <th>Thumbnail</th>

                            <th>Member</th>

                            <th>Feedback</th>

                            <th class="text-center">Actions</th>
                        </tr>
                    </thead>

                    <tbody>
                        @foreach($feedbacks as $feedback)
                            <tr>
                                <td class="align-middle">
                                    <img
                                        src="{{ $feedback->member->avatar ?
                                            $feedback->member->avatar :
                                            '/img/logo.png' }}"
                                        height="50"
                                        alt="{{ $feedback->member->name }}"
                                    >
                                </td>

                                <td class="align-middle">
                                    {{ $feedback->member->name }}
                                </td>

                                <td class="align-middle text-capitalize">
                                    {{ $feedback->feedback }}
                                </td>

                                <td class="text-center align-middle">

                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>

                {{ $feedbacks->links() }}
            @endif
        </div>
    </div>
@endsection