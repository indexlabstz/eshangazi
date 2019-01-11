@extends('layouts.app')

@section('content')
<div class="card-body">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
        <h1 class="h2">
            FAQs Questions
        </h1>

        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group">
                <a href="{{ route('create-question') }}" class="btn btn-sm btn-outline-secondary">
                    New Question
                </a>
            </div>
        </div>
    </div>    
    <div>
        @if($questions->isEmpty())
            <p class="lead text-muted">
                No data to display at the moment.
            </p>                   

            <a href="{{ route('create-question') }}" class="btn btn-primary">
                Click here to add new Question
            </a>                      
        @else
          <div class="accordion" id="accordion">
            @foreach($questions as $question)
            <div class="card">
              <div class="card-header" id="heading-{{$loop->iteration}}">
                <h5 class="mb-0">
                  <button class="btn btn-link" type="button" data-toggle="collapse" data-target="#collapse-{{$loop->iteration}}" aria-expanded="false">
                    {{ $question->question }}
                  </button>
                </h5>
              </div>

              <div id="collapse-{{$loop->iteration}}" class="collapse show" aria-labelledby="heading-{{$loop->iteration}}" data-parent="#accordion">
                <div class="card-body">
                  @foreach($question->answers as $answer)
                    {{ $answer->answer }}
                  @endforeach
                </div>
              </div>
            </div>
            @endforeach
          </div>

          {{ $questions->links() }}
        @endif
    </div>
</div>
@endsection
