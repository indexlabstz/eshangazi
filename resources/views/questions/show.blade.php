@extends('layouts.app')

@section('content')
<div class="card-body">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">
            Question Details
        </h1>

        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group">
                <a href="{{ route('index-question') }}" class="btn btn-sm btn-outline-secondary">
                    Questions List
                </a>
            </div>
        </div>
    </div>    

    <section class="jumbotron">
        <h1 class="jumbotron-heading">
            {{ $question->category->name }}
        </h1>

        <p class="lead text-muted">
            {{ $question->question }}
        </p>

        <p class="card-text">
            <small class="text-muted">
                Created by: 
                <a href="#">
                    {{ $question->creator->name }}  
                </a>

                {{ $question->created_at->toFormattedDateString() }}
            </small>
        </p>
    </section>

    <section class="relation">
        <ul class="nav nav-tabs" id="questionTab" role="tablist">
            <li class="nav-item">
                <a class="nav-link active" id="answer-tab" data-toggle="tab" href="#answer" role="tab" aria-controls="answer" aria-selected="true">
                    Answers
                </a>
            </li>
        </ul>

        <div class="tab-content" id="questionTabRelation">
            <div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="details-tab">
            <div class="table-responsive">
                    @if($question->answers->isEmpty())
                        <p class="lead text-muted">
                            No data to display at the moment.
                        </p>                        
                    @else
                        <table class="table table-striped table-sm">
                            <thead>
                                <tr>
                                    <th>Answer</th>

                                    <th>Correct?</th>

                                    <th class="text-center">Actions</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach($question->answers as $answer)
                                    <tr>
                                        <td class="align-middle">
                                            {{ $answer->answer }}
                                        </td>

                                        <td class="align-middle">
                                            {{ $answer->correct ? 'Correct' : 'Not Correct' }}
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
                    @endif
                </div>
            </div>
        </div>
    </section>        
</div>
@endsection

@section('scripts')
    <script>
        $('#questionTab a').on('click', function (e) {
            e.preventDefault()
            $(this).tab('show')
        })
    </script>    
@endsection
