@extends('layouts.app')

@section('content')
<div class="card-body">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
        <h1 class="h2">
            Answers
        </h1>

        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group">
                <a href="{{ route('create-answer') }}" class="btn btn-sm btn-outline-secondary">
                    New Answer
                </a>
            </div>
        </div>
    </div>    

    <div class="table-responsive">
        @if($answers->isEmpty())
            <p class="lead text-muted">
                No data to display at the moment.
            </p>                   

            <a href="{{ route('create-answer') }}" class="btn btn-primary">
                Click here to add new Answer
            </a>                      
        @else
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>Answer</th>

                        <th>Question</th>

                        <th class="text-center">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($answers as $answer)
                        <tr>
                            <td class="align-middle">
                                {{ $answer->answer }}
                            </td>

                            <td class="align-middle">
                                {{ $answer->question->question }}
                            </td>
                            
                            <td class="text-center align-middle">
                                <form action="{{ route('delete-answer', $answer) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE')}}

                                    <div class="btn-group">
                                        <a href="{{ route('show-answer', $answer) }}" class="btn btn-sm btn-outline-secondary">
                                            Show
                                        </a>

                                        <a href="{{ route('edit-answer', $answer) }}" class="btn btn-sm btn-outline-secondary">
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

            {{ $answers->links() }}
        @endif
    </div>
</div>
@endsection