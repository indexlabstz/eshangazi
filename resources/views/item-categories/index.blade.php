@extends('layouts.app')

@section('content')
<div class="card-body">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">
      Categories
    </h1>

    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group">
        <a href="{{ route('create-item-category') }}" class="btn btn-sm btn-outline-secondary">
            New Category
        </a>
        <a href="{{ route('deleted-item-category') }}" class="btn btn-sm btn-outline-secondary">
            Trashed Categories
        </a>
      </div>
    </div>
  </div>
  @if($item_categories->isEmpty())
    <p class="lead text-muted">
      No data created at the moment.
    </p>
    <a href="{{ route('create-item-category') }}" class="btn btn-primary">Click here to add new Item Category </a>       
  @else   

    <div class="table-responsive">
      <table class="table table-striped table-sm">
        <thead>
          <tr>
            <th>Thumbnail</th>

            <th>Name</th>
            
            <th class="text-center">Actions</th>
          </tr>
        </thead>

        <tbody>
          @foreach($item_categories as $item_category)
            <tr>
              <td class="align-middle">
                <img src="{{ $item_category->thumbnail ? (env('AWS_URL') . '/' . $item_category->thumbnail) : '/img/demo.jpg' }}" height="50" alt="{{ $item_category->name }}">
              </td>

              <td class="align-middle">
                {{ $item_category->name}}
              </td>
              
              <td class="text-center align-middle">
                <form action="{{ route('delete-item-category', $item_category) }}" method="POST">
                  {{ csrf_field() }}
                  {{ method_field('DELETE')}}

                    <div class="btn-group">
                      <a href="{{ route('show-item-category', $item_category) }}" class="btn btn-sm btn-outline-secondary">
                        Show
                      </a>

                      <a href="{{ route('edit-item-category', $item_category) }}" class="btn btn-sm btn-outline-secondary">
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

        {{ $item_categories->links() }}
    </div>
    @endif
</div>
@endsection