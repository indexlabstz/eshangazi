@extends('layouts.app')

@section('content')
<div class="card-body">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">
            Message Details
        </h1>

        <div class="btn-toolbar mb-2 mb-md-0">
            <form action="{{ route('publish-message', $message) }}" method="POST">
                {{ csrf_field() }}
                {{ method_field('PUT')}}

                <div class="btn-group">
                    @if($message->status == 'draft')
                        <button type="submit" class="btn btn-sm btn-secondary">
                            Publish Message
                        </button>
                    @endif

                    <a href="{{ route('index-message') }}" class="btn btn-sm btn-outline-secondary">
                        Messages List
                    </a>
                </div>
            </form>
        </div>
    </div>    

    <section class="jumbotron">
        <h1 class="jumbotron-heading">
            {{ $message->title }}
        </h1>

        <p class="lead text-muted">
            {{ $message->description }}
        </p>

        <p class="card-text">
            <small class="text-muted">
                Created by: 
                <a href="#">
                    {{ $message->creator->name }}  
                </a>

                {{ $message->created_at->diffForHumans() }}
            </small>
        </p>
    </section>

    <section class="relation">
        <ul class="nav nav-tabs" id="messageTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="details-tab" data-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="true">
                    Details
                </a>
            </li>
        </ul>

        <div class="tab-content" id="messageTabRelation">
            <div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="details-tab">
            <div class="table-responsive">
                    @if($message->details->isEmpty())
                        <p class="lead text-muted">
                            No data to display at the moment.
                        </p>                        
                    @else
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Thumbnail</th>

                                    <th>Title</th>

                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($message->details as $detail)
                                    <tr>
                                        <td class="align-middle">
                                            <img src="{{ asset('img/demo.jpg') }}" height="50" alt="{{ $detail->title }}">
                                        </td>

                                        <td class="align-middle">
                                            {{ $detail->title }}
                                        </td>
                                        
                                        <td class="text-center align-middle">
                                            <form action="{{ route('delete-message-detail', $detail) }}" method="POST">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE')}}

                                                <div class="btn-group">
                                                    <a href="{{ route('show-message-detail', $detail) }}" class="btn btn-sm btn-outline-secondary">
                                                        Show
                                                    </a>

                                                    <a href="{{ route('edit-message-detail', $detail) }}" class="btn btn-sm btn-outline-secondary">
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
        $('#messageTab a').on('click', function (e) {
            e.preventDefault()
            $(this).tab('show')
        })
    </script>    
@endsection
