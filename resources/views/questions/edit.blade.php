@extends('layouts.app')

@section('content')
<div class="card-body">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">
            Edit Question
        </h1>

        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group">
                <a href="{{ route('index-question') }}" class="btn btn-sm btn-outline-secondary">
                    Questions List
                </a>
            </div>
        </div>
    </div>    
    
    <form method="POST" action="{{ route('update-question', $question) }}">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <label for="question">
                Question
            </label>

            <input id="question" name="question" type="text" class="form-control{{ $errors->has('question') ? ' is-invalid' : '' }}" 
                value="{{ $question->question }}" placeholder="question" required autofocus>

            @if ($errors->has('question'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('question') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">  
                @if($question->type == 'truth')              
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="type" id="truth" value="truth" checked required>
                        <label class="form-check-label" for="truth">True/False</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="type" id="multiple" value="multiple" required>
                        <label class="form-check-label" for="multiple">Multiple Choice</label>
                    </div>
                @else
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="type" id="truth" value="truth" required>
                        <label class="form-check-label" for="truth">True/False</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="type" id="multiple" value="multiple" checked required>
                        <label class="form-check-label" for="multiple">Multiple Choice</label>
                    </div>
                @endif

                @if ($errors->has('type'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('type') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group col-md-6">
                @if($question->difficulty == 'easy')
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="difficulty" id="easy" value="easy" checked required>
                        <label class="form-check-label" for="easy">Easy</label>
                    </div>
                    
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="difficulty" id="medium" value="medium" required>
                        <label class="form-check-label" for="medium">Medium</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="difficulty" id="hard" value="hard" required>
                        <label class="form-check-label" for="hard">Hard</label>
                    </div>
                @elseif($question->difficulty == 'medium')
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="difficulty" id="easy" value="easy" required>
                        <label class="form-check-label" for="easy">Easy</label>
                    </div>
                    
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="difficulty" id="medium" value="medium" checked required>
                        <label class="form-check-label" for="medium">Medium</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="difficulty" id="hard" value="hard" required>
                        <label class="form-check-label" for="hard">Hard</label>
                    </div>
                @else
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="difficulty" id="easy" value="easy" required>
                        <label class="form-check-label" for="easy">Easy</label>
                    </div>
                    
                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="difficulty" id="medium" value="medium" required>
                        <label class="form-check-label" for="medium">Medium</label>
                    </div>

                    <div class="form-check form-check-inline">
                        <input class="form-check-input" type="radio" name="difficulty" id="hard" value="hard" checked required>
                        <label class="form-check-label" for="hard">Hard</label>
                    </div>
                @endif
                

                @if ($errors->has('difficulty'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('difficulty') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-group">
            <label for="question_category_id">
                Category
            </label>

            <select id="question_category_id" name="question_category_id" class="form-control{{ $errors->has('question_category_id') ? ' is-invalid' : '' }}" required>
                <option disabled>
                    Choose Category...
                </option>

                @foreach($categories as $category)
                    @if($category->id == $question->question_category_id)
                        <option value="{{ $category->id  }}" selected>{{ $category->name }}</option>
                    @else
                        <option value="{{ $category->id  }}">{{ $category->name }}</option>
                    @endif
                @endforeach
            </select>

            @if ($errors->has('question_category_id'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('question_category_id') }}</strong>
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