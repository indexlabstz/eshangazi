@extends('layouts.dashboard')

@section('content')
    <div class="w-full lg:ml-376">
        <div class="flex px-three-five-px pt-12 pb-6">
            <main class="min-h-full w-full">
                <section class="w-full">
                    <h2 class="flex items-center mb-8 font-semibold text-xl">
                        <span class="block h-px flex-grow bg-telluric-blue-opacity-10"></span>

                        <span class="mx-8"> It's easier to create a new message </span>

                        <span class="block h-px flex-grow bg-telluric-blue-opacity-10"></span>
                    </h2>

                    <div class="flex items-center sm:flex-row flex-col mx-8 mb-8">
                        <p class="text-sm">
                            Creating a message that will be sent to members of the bot, after creating the message copy title of the message and add it to entity section in <a href="https://dialogflow.com" target="_blank">Dialogflow</a>.
                        </p>
                    </div>

                    <form method="POST" action="{{ route('store-message') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="flex sm:flex-row flex-col -mx-2 border-red border-1">
                            <input autocapitalize="none"
                                   autocomplete="off"
                                   autocorrect="off"
                                   class="flex-1 bg-moon-grey rounded mx-2 mb-4 py-4 px-6 text-telluric-blue shadow-none outline-none{{ $errors->has("title") ? " border border-red" : "" }}"
                                   id="title"
                                   placeholder="Message Title"
                                   spellcheck="false"
                                   type="text"
                                   name="title"
                                   value="{{ old('title') }}">
                        </div>

                        @if ($errors->has('title'))
                            <div class="text-red mb-5">
                                <p class="text-sm">{{ $errors->first('title') }}</p>
                            </div>
                        @endif

                        <div class="flex sm:flex-row flex-col -mx-2">
                            <textarea class="block w-full h-184 mb-8 bg-moon-grey rounded mx-2 mb-4 py-4 px-6 text-telluric-blue resize-none shadow-none outline-none leading-normal{{ $errors->has("description") ? " border border-red" : "" }}"
                                  id="description"
                                  placeholder="Message description goes here."
                                  name="description" 
                                  required="required">{{ old('description') }}</textarea>
                        </div>  

                        @if ($errors->has('description'))
                            <div class="text-red mb-5">
                                <p class="text-sm">{{ $errors->first('description') }}</p>
                            </div> 
                        @endif

                        <div class="flex sm:flex-row flex-col -mx-2">
                            <div class="flex-1">
                                <div class="flex items-center flex-1 bg-moon-grey rounded py-4 px-6 mx-2 mb-4{{ $errors->has("gender") ? " border border-red" : "" }}">
                                    <select class="w-full bg-moon-grey text-telluric-blue appearance-none shadow-none outline-none" 
                                        id="gender"
                                        name="gender"
                                        value="{{ old('gender') }}">
                                        <option selected>
                                            Target gender for this message...
                                        </option>

                                        <option value="male" @if (old('gender') == "male") {{ 'selected' }} @endif>
                                            Male
                                        </option>

                                        <option value="female" @if (old('gender') == "female") {{ 'selected' }} @endif>
                                            Female
                                        </option>

                                        <option value="both" @if (old('gender') == "both") {{ 'selected' }} @endif>
                                            Both
                                        </option>
                                    </select>

                                    <div class="flex-no-grow flex-no-shrink h-1 text-solstice-blue opacity-75 fill-current">
                                        <svg class="block h-full" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 14 8">
                                            <path d="M7,8a1,1,0,0,1-.71-.29l-6-6A1,1,0,0,1,1.71.29L7,5.59,12.29.29a1,1,0,1,1,1.42,1.42l-6,6A1,1,0,0,1,7,8Z"></path>
                                        </svg>
                                    </div>
                                </div>

                                @if ($errors->has('gender'))
                                    <div class="text-red mb-5 px-2">
                                        <p class="text-sm">{{ $errors->first('gender') }}</p>
                                    </div> 
                                @endif
                            </div>

                            <div class="flex-1 py-0 px-4">
                                <input autocapitalize="none"
                                   autocomplete="off"
                                   autocorrect="off"
                                   class="flex-1 w-full bg-moon-grey rounded mx-2 mb-4 py-4 px-6 text-telluric-blue shadow-none outline-none"
                                   id="minimum_age"
                                   placeholder="What the minimum age for this message?"
                                   spellcheck="false"
                                   type="text"
                                   value="13"
                                   name="minimum_age"
                                   value="{{ old('minimum_age') }}">

                                @if ($errors->has('minimum_age'))
                                    <div class="text-red mb-5 px-2">
                                        <p class="text-sm">{{ $errors->first('minimum_age') }}</p>
                                    </div>
                                @endif
                            </div>
                            
                        </div>

                        <div class="flex justify-center mt-5">
                            <div class="block h-px flex-grow bg-telluric-blue-opacity-10"></div>
                        </div>

                        <div class="flex justify-center mt-8">
                            <button class="btn-skeuomorphic py-4 px-10 focus:outline-none focus:shadow-outline">
                                Submit
                            </button>
                        </div>
                    </form>
                </section>
            </main>
        </div>
    </div>

{{--<div class="card-body">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
        <h1 class="h2">
            New Message
        </h1>

        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group">
                <a href="{{ route('index-message') }}" class="btn btn-sm btn-outline-secondary">
                    Messages List
                </a>
            </div>
        </div>
    </div>    
    
    <form method="POST" action="{{ route('store-message') }}" enctype="multipart/form-data">
        @csrf

        <div class="form-group">
            <label for="title">
                Title
            </label>

            <input id="title" name="title" type="text" class="form-control{{ $errors->has('title') ? ' is-invalid' : '' }}" 
                value="{{ old('title') }}" placeholder="Title" required autofocus>

            @if ($errors->has('title'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('title') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-group">
            <label for="description">Description</label>

            <textarea id="description" name="description" class="form-control{{ $errors->has('description') ? ' is-invalid' : '' }}" 
                row="3" required>{{ old('description') }}</textarea>

            @if ($errors->has('description'))
                <span class="invalid-feedback">
                    <strong>{{ $errors->first('description') }}</strong>
                </span>
            @endif
        </div>

        <div class="form-row">
            <div class="form-group col-md-6">
                <label for="gender">
                    Gender
                </label>

                <select id="gender" name="gender" class="form-control{{ $errors->has('gender') ? ' is-invalid' : '' }}" required>
                    <option selected>
                        Choose gender...
                    </option>

                    <option value="male">
                        Male
                    </option>

                    <option value="female">
                        Female
                    </option>

                    <option value="both">
                        Both
                    </option>
                </select>

                @if ($errors->has('gender'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('gender') }}</strong>
                    </span>
                @endif
            </div>

            <div class="form-group col-md-6">
                <label for="minimum_age">
                    Age
                </label>

                <input id="minimum_age" name="minimum_age" type="number" class="form-control{{ $errors->has('minimum_age') ? ' is-invalid' : '' }}" 
                    value="{{ old('minimum_age') }}" placeholder="Minimum Age" required>

                @if ($errors->has('minimum_age'))
                    <span class="invalid-feedback">
                        <strong>{{ $errors->first('minimum_age') }}</strong>
                    </span>
                @endif
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="thumbnail">Thumbnail</label>

                <input  id="thumbnail" name="thumbnail" type="file" class="form-control-file">
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
</div>--}}
@endsection
