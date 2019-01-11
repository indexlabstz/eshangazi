@extends('layouts.app')

@section('content')
<div class="card-body">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">
            Edit Detail
        </h1>

        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group">
                <a href="{{ route('index-message-detail') }}" class="btn btn-sm btn-outline-secondary">
                    Details List
                </a>
            </div>
        </div>
    </div>    
    
    <form method="POST" action="{{ route('update-message-detail', $message_detail) }}" enctype="multipart/form-data">
        @csrf
        @method('PATCH')

        <div class="form-group">
            <label for="title">
                Title
            </label>

            <input id="title" name="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" 
                value="{{ $message_detail->title }}" placeholder="Title" required autofocus>

            @if ($errors->has('title'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <label for="description">Description</label>

            <textarea id="description" name="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" 
                row="3" required>{{ $message_detail->description }}</textarea>

            @if ($errors->has('description'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">                
                <label for="thumbnail">Thumbnail</label>

                <input  id="thumbnail" name="thumbnail" type="file" class="form-control-file">
            </div>

            <div class="form-group col-md-6">
                <label for="message_id">
                    Message
                </label>

                <select id="message_id" name="message_id" class="form-control{{ $errors->has('message_id') ? ' is-invalid' : '' }}" required>
                    <option disabled>
                        Choose Message...
                    </option>

                    @foreach($messages as $message)
                        @if($message->id == $message_detail->message_id)
                            <option value="{{ $message->id  }}" selected>{{ $message->title }}</option>
                        @else
                            <option value="{{ $message->id  }}">{{ $message->title }}</option>
                        @endif
                    @endforeach
                </select>

                @if ($errors->has('message_id'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('message_id') }}</strong>
                    </span>
                @endif
            </div>
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