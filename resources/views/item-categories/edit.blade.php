@extends('layouts.app')

@section('content')
    <div class="card-body">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">
                Edit Category
            </h1>

            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group">
                    <a href="{{ route('index-item-category') }}" class="btn btn-sm btn-outline-secondary">
                        Categories List
                    </a>
                </div>
            </div>
        </div>

        <form method="POST"
              action="{{ route('update-item-category', $item_category) }}"
              enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="name">
                        Name
                    </label>

                    <input id="name"
                           name="name"
                           type="text"
                           class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                           value="{{ $item_category->name }}"
                           placeholder="Name"
                           required
                           autofocus>

                    @if ($errors->has('name'))
                        <span class="invalid-feedback">
                        <strong>
                            {{ $errors->first('name') }}
                        </strong>
                    </span>
                    @endif
                </div>

                <div class="form-group col-md-6">
                    <label for="display_title">
                        Display Title
                    </label>

                    <input id="display_title"
                           name="display_title"
                           type="text"
                           class="form-control{{ $errors->has('display_title') ? ' is-invalid' : '' }}"
                           value="{{ $item_category->display_title }}"
                           placeholder="Display Title"
                           required>

                    @if ($errors->has('display_title'))
                        <span class="invalid-feedback">
                            <strong>
                                {{ $errors->first('display_title') }}
                            </strong>
                        </span>
                    @endif
                </div>
            </div>


            <div class="form-group">
                <label for="description">
                    Description
                </label>

                <textarea id="description"
                          name="description"
                          class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                          row="3"
                          required>
                    {{ $item_category->description }}
                </textarea>

                @if ($errors->has('description'))
                    <span class="invalid-feedback">
          <strong>{{ $errors->first('description') }}</strong>
        </span>
                @endif
            </div>

            <div class="form-row">
                <div class="form-group">
                    <label for="thumbnail">Thumbnail</label>

                    <input id="thumbnail" name="thumbnail" type="file" class="form-control-file">
                </div>
            </div>
            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mt-3 border-top">
                <h1 class="h2">
                    &nbsp;
                </h1>

                <div class="btn-toolbar mb-2 mb-md-0">
                    <button type="submit" class="btn btn-primary mt-3">Update</button>
                </div>
            </div>
        </form>
    </div>
@endsection
