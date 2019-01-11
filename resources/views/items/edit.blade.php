@extends('layouts.app')

@section('content')
    <div class="card-body">
        <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
            <h1 class="h2">
                Edit Item
            </h1>

            <div class="btn-toolbar mb-2 mb-md-0">
                <div class="btn-group">
                    <a href="{{ route('index-item') }}" class="btn btn-sm btn-outline-secondary">
                        Items List
                    </a>
                </div>
            </div>
        </div>

        <form method="POST" action="{{ route('update-item', $item) }}" enctype="multipart/form-data">
            @csrf
            @method('PATCH')

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="title">
                        Title
                    </label>

                    <input id="title" name="title"
                           type="text"
                           class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}"
                           value="{{ $item->title }}"
                           placeholder="Title"
                           required
                           autofocus>

                    @if ($errors->has('title'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('title') }}</strong>
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6">
                    <label>
                        Choose Category
                    </label>

                    <select name="item_category_id"
                            class="form-control{{ $errors->has('item_category_id') ? ' is-invalid' : '' }}"
                            title="Select Category"
                            required>

                        <option value="">
                            Select Category
                        </option>

                        @foreach($item_categories as $category)
                            <option value="{{$category->id}}" {{ $item->item_category_id == $category->id ? "selected":"" }}>
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>

                    @if ($errors->has('item_category_id'))
                        <div class="invalid-feedback">
                            <strong>
                                {{ $errors->first('item_category_id') }}
                            </strong>
                        </div>
                    @endif
                </div>
            </div>

            <div class="form-group">
                <label for="description">
                    Description
                </label>

                <textarea
                        id="description"
                        name="description"
                        class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}"
                        row="3"
                        required>{{ $item->description }}</textarea>

                @if ($errors->has('description'))
                    <span class="invalid-feedback">
                        <strong>
                            {{ $errors->first('description') }}
                        </strong>
                    </span>
                @endif
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="gender">
                        Targeted Gender
                    </label>

                    <select id="gender"
                            name="gender"
                            class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}"
                            required>
                        <option selected>
                            Choose gender...
                        </option>

                        <option value="male" {{ $item->gender == "male" ? "selected" : "" }}>
                            Male
                        </option>

                        <option value="female" {{ $item->gender == "female" ? "selected" : "" }}>
                            Female
                        </option>

                        <option value="both" {{ $item->gender == "both" ? "selected" : "" }}>
                            Both
                        </option>
                    </select>

                    @if ($errors->has('gender'))
                        <span class="invalid-feedback">
                            <strong>
                                {{ $errors->first('gender') }}
                            </strong>
                        </span>
                    @endif
                </div>

                <div class="form-group col-md-6">
                    <label for="minimum_age">
                        Age
                    </label>

                    <input id="minimum_age"
                           name="minimum_age"
                           type="number"
                           class="form-control{{ $errors->has('minimum_age') ? ' is-invalid' : '' }}"
                           value="{{ $item->minimum_age }}"
                           placeholder="Minimum Age"
                           required>

                    @if ($errors->has('minimum_age'))
                        <span class="invalid-feedback">
                            <strong>{{ $errors->first('minimum_age') }}</strong>
                        </span>
                    @endif
                </div>
            </div>

            <div class="form-row">
                <div class="form-group col-md-6">
                    <label for="display_title">
                        Display Title
                    </label>

                    <input id="display_title"
                           name="display_title"
                           type="text"
                           class="form-control{{ $errors->has('display_title') ? ' is-invalid' : '' }}"
                           value="{{ $item->display_title }}"
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

                <div class="form-group col-md-6">
                    <label>
                        Choose Item
                    </label>

                    <select name="item_id"
                            class="form-control{{ $errors->has('item_id') ? ' is-invalid' : '' }}"
                            title="Select Item">
                        <option value="">
                            Select Item
                        </option>

                        @foreach($items as $itemm)
                            <option value="{{$itemm->id}}" {{ $itemm->id == $item->item_id ? "selected":"" }}>
                                {{ $itemm->title }}
                            </option>
                        @endforeach
                    </select>

                    @if ($errors->has('item_id'))
                        <div class="invalid-feedback">
                            <strong>{{ $errors->first('item_id') }}</strong>
                        </div>
                    @endif
                </div>

                <div class="form-group">
                    <label for="thumbnail">Thumbnail</label>

                    <input id="thumbnail"
                           name="thumbnail"
                           type="file"
                           class="form-control-file">
                </div>
            </div>

            <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mt-3 border-top">
                <h1 class="h2">
                    &nbsp;
                </h1>

                <div class="btn-toolbar mb-2 mb-md-0">
                    <button type="submit" class="btn btn-primary mt-3">
                        Submit
                    </button>
                </div>
            </div>
        </form>
    </div>
@endsection

