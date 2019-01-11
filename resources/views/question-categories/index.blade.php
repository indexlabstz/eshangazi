@extends('layouts.app')

@section('content')
<div class="card-body">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
        <h1 class="h2">
            Question Categories
        </h1>

        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group">
                <a href="{{ route('create-question-category') }}" class="btn btn-sm btn-outline-secondary">
                    New Category
                </a>
            </div>
        </div>
    </div>    

    <div class="table-responsive">
        @if($question_categories->isEmpty())
            <p class="lead text-muted">
                No data to display at the moment.
            </p>     
                           

            <a href="{{ route('create-question-category') }}" class="btn btn-primary">
                Click here to add new Category
            </a>                     
        @else
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($question_categories as $category)
                        <tr>
                            <td class="align-middle">
                                {{ $category->name }}
                            </td>
                            
                            <td class="text-center align-middle">
                                <form action="{{ route('delete-question-category', $category) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE')}}

                                    <div class="btn-group">
                                        <a href="{{ route('show-question-category', $category) }}" class="btn btn-sm btn-outline-secondary">
                                            Show
                                        </a>

                                        <a href="{{ route('edit-question-category', $category) }}" class="btn btn-sm btn-outline-secondary">
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

            {{ $question_categories->links() }}
        @endif
    </div>
</div>
@endsection