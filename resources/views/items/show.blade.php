@extends('layouts.app')

@section('content')
    <div class="card-body">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">
                Item Details
            </h1>

            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group">
                    <a href="{{ route('index-item') }}" class="btn btn-sm btn-outline-secondary">
                        Items List
                    </a>
                </div>
            </div>
        </div>

        <section class="jumbotron">
            <h1 class="jumbotron-heading">
                {{ $item->title }}
            </h1>

            <p class="lead text-muted">
                {{ $item->description }}
            </p>
            <p class="card-text">
                <small class="text-muted">
                    Created by:
                    <a href="#" class="">
                        {{$item->creator->name}}
                    </a>
                    on
                    {{$item->created_at->toFormattedDateString()}}
                </small>
            </p>
            <p class="card-text">
                <a href="{{ route('edit-item', $item) }}" class="btn btn-sm btn-outline-secondary">
                    Edit Info
                </a>
            </p>
        </section>

        <section class="relation">
            <ul class="nav nav-tabs" id="itemTab" role="tablist">
                <li class="nav-item">
                    <a id="items-tab"
                       class="nav-link active"
                       data-toggle="tab"
                       href="#items"
                       role="tab"
                       aria-controls="items"
                       aria-selected="true">
                        Items
                    </a>
                </li>
            </ul>

            <div class="tab-content" id="itemsTabRelation">
                <div id="items" class="tab-pane fade show active" role="tabpanel" aria-labelledby="items-tab">
                    @if($item->items->isEmpty())
                        <p class="lead text-muted mt-2">
                            No child item available.
                        </p>
                    @else
                        <div class="table-responsive mt-2">
                            <table class="table table-striped table-sm">
                                <thead>
                                <tr>
                                    <th>Thumbnail</th>

                                    <th>Title</th>

                                    <th class="text-center">
                                        Actions
                                    </th>
                                </tr>
                                </thead>

                                <tbody>
                                @foreach($item->items as $item)
                                    <tr>
                                        <td class="align-middle">
                                            <img src="{{ $item->thumbnail ? (env('AWS_URL') . '/' . $item->thumbnail) : '/img/demo.jpg' }}"
                                                 height="50" alt="{{ $item->title }}">
                                        </td>

                                        <td class="align-middle">
                                            {{ $item->title}}
                                        </td>

                                        <td class="text-center align-middle">
                                            <form action="{{ route('delete-item', $item) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE')}}

                                                <div class="btn-group">
                                                    <a href="{{ route('show-item', $item) }}"
                                                       class="btn btn-sm btn-outline-secondary">
                                                        Show
                                                    </a>

                                                    <a href="{{ route('edit-item', $item) }}"
                                                       class="btn btn-sm btn-outline-secondary">
                                                        Edit
                                                    </a>

                                                    <button type="submit" class="btn btn-sm btn-outline-secondary">
                                                        Delete
                                                    </button>
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
        $('#itemTab a').on('click', function (e) {
            e.preventDefault()
            $(this).tab('show')
        })
    </script>
@endsection