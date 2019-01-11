@extends('layouts.app')

@section('content')
<div class="card-body">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">
            Edit Answer
        </h1>

        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group">
                <a href="{{ route('index-answer') }}" class="btn btn-sm btn-outline-secondary">
                    Answers List
                </a>
            </div>
        </div>
    </div>    
    
    <form method="POST" action="{{ route('update-answer', $answer) }}">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <label for="answer">
                Answer
            </label>

            <input id="answer" name="answer" type="text" class="form-control{{ $errors->has('answer') ? ' is-invalid' : '' }}" 
                value="{{ $answer->answer }}" placeholder="Answer" required autofocus>

            @if ($errors->has('answer'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('answer') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group"> 
            @if($answer->correct == 1)               
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="correct" id="correct" value="1" checked required>
                    <label class="form-check-label" for="correct">Correct Answer</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="correct" id="not-correct" value="0" required>
                    <label class="form-check-label" for="not-correct">Not Correct</label>
                </div>
            @else
                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="correct" id="correct" value="1" required>
                    <label class="form-check-label" for="correct">Correct Answer</label>
                </div>

                <div class="form-check form-check-inline">
                    <input class="form-check-input" type="radio" name="correct" id="not-correct" value="0" checked required>
                    <label class="form-check-label" for="not-correct">Not Correct</label>
                </div>
            @endif

            @if ($errors->has('correct'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('correct') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <label for="question_id">
                Question
            </label>

            <select id="question_id" name="question_id" class="form-control{{ $errors->has('question_id') ? ' is-invalid' : '' }}" required>
                <option disabled>
                    Choose Question...
                </option>

                @foreach($questions as $question)
                    @if($question->id == $answer->question_id)
                        <option value="{{ $question->id  }}" selected>{{ $question->question }}</option>
                    @else
                        <option value="{{ $question->id  }}">{{ $question->question }}</option>
                    @endif
                @endforeach
            </select>

            @if ($errors->has('question_id'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('question_id') }}</strong>
                </span>
            @endif
        </div>

        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mt-3 border-top">
            <h1 class="h2">
                &nbsp;
            </h1>

            <div class="btn-toolbar mb-2 mb-md-0">
                <button type="submit" class="btn btn-primary mt-3">Submit</button>
            </div>
        </div> 
    </form>
</div>
@endsection
