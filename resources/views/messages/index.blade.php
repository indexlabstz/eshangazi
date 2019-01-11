@extends('layouts.app')

@section('content')
<div class="card-body">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
        <h1 class="h2">
            Messages
        </h1>

        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group">
                <a href="{{ route('create-message') }}" class="btn btn-sm btn-outline-secondary">
                    New Message
                </a>
            </div>
        </div>
    </div>    

    <div class="table-responsive">
        @if($messages->isEmpty())
            <p class="lead text-muted">
                No data to display at the moment.
            </p>                   

            <a href="{{ route('create-message') }}" class="btn btn-primary">
                Click here to add new Message
            </a>                     
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
                    @foreach($messages as $message)
                        <tr>
                            <td class="align-middle">
                                <img src="{{ asset('img/demo.jpg') }}" height="50" alt="{{ $message->title }}">
                            </td>

                            <td class="align-middle">
                                {{ $message->title }}
                            </td>
                            
                            <td class="text-center align-middle">
                                <form action="{{ route('delete-message', $message) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE')}}

                                    <div class="btn-group">
                                        <a href="{{ route('show-message', $message) }}" class="btn btn-sm btn-outline-secondary">
                                            Show
                                        </a>

                                        <a href="{{ route('edit-message', $message) }}" class="btn btn-sm btn-outline-secondary">
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

            {{ $messages->links() }}
        @endif
    </div>
</div>
@endsection