@extends('layouts.app')

@section('content')
    <div class="card-body">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
            <h1 class="h2">
                Ads
            </h1>

            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group">
                    <a href="{{ route('create-ad') }}" class="btn btn-sm btn-outline-secondary">
                        New Ad
                    </a>
                </div>
            </div>
        </div>

        <div class="table-responsive">
            @if($ads->isEmpty())
                <p class="lead text-muted">
                    No data to display at the moment.
                </p>

                <a href="{{ route('create-ad') }}" class="btn btn-primary">
                    Click here to add new Ad
                </a>
            @else
                <table class="table table-striped table-sm">
                    <thead>
                    <tr>
                        <th>Thumbnail</th>

                        <th>Title</th>

                        <th>Partner</th>

                        <th>Status</th>

                        <th class="text-center">Actions</th>
                    </tr>
                    </thead>

                    <tbody>
                    @foreach($ads as $ad)
                        <tr>
                            <td class="align-middle">
                                <img src="{{ $ad->thumbnail ? (env('AWS_URL') . '/' . $ad->thumbnail) : '/img/demo.jpg' }}" height="50" alt="{{ $ad->title }}">
                            </td>

                            <td class="align-middle">
                                {{ $ad->title }}
                            </td>

                            <td class="align-middle">

                                {{ $ad->partner->name }}

                            </td>

                            <td class="align-middle text-capitalize">
                                <span class="badge badge-primary">
                                    {{ $ad->status }}
                                </span>
                            </td>

                            <td class="text-center align-middle">
                                <form action="{{ route('destroy-ad', $ad) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE')}}

                                    <div class="btn-group">
                                        <a href="{{ route('show-ad', $ad) }}" class="btn btn-sm btn-outline-secondary">
                                            Show
                                        </a>

                                        <a href="{{ route('edit-ad', $ad) }}" class="btn btn-sm btn-outline-secondary">
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

                {{ $ads->links() }}
            @endif
        </div>
    </div>
@endsection