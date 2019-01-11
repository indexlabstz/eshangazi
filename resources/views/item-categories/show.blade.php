@extends('layouts.app')

@section('content')
<div class="card-body">
  <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
    <h1 class="h2">
      Category Details
    </h1>

    <div class="btn-toolbar mb-2 mb-md-0">
      <div class="btn-group">
        <a href="{{ route('index-item-category') }}" class="btn btn-sm btn-outline-secondary">
          Categories List
        </a>
      </div>
    </div>
  </div>    

  <section class="jumbotron">
    <h1 class="jumbotron-heading">
      {{ $item_category->name }}
    </h1>

    <p class="lead text-muted">
        {{ $item_category->description }}
    </p>
    <p class="card-text">
      <small class="text-muted">
        Created by: 
        <a href="#" class="">
            {{$item_category->creator->name}}
        </a> 
        on 
        {{$item_category->created_at->toFormattedDateString()}}
      </small>
    </p>
  </section>
    
  <section class="relation">
    <ul class="nav nav-tabs" id="itemCategoryTab" role="tablist">
      <li class="nav-item">
        <a class="nav-link active" id="items-tab" data-toggle="tab" href="#items" role="tab" aria-controls="items" aria-selected="true">Items</a>
      </li>
    </ul>

    <div class="tab-content" id="itemsTabRelation">
      <div class="tab-pane fade show active" id="items" role="tabpanel" aria-labelledby="partners-tab">
        @if($item_category->items->isEmpty())
          <p class="lead text-muted mt-2">
            No Item Associeated with this category at the moment.
          </p>     
        @else   

          <div class="table-responsive mt-2">
            <table class="table table-striped table-sm">
              <thead>
                <tr>
                  <th>Thumbnail</th>

                  <th>Title</th>

                  <th class="text-center">Actions</th>
                </tr>
              </thead>

              <tbody>
                @foreach($item_category->items as $item)
                  <tr>
                    <td class="align-middle">
                      <img src="{{ $item->thumbnail ? (env('AWS_URL') . '/' . $item->thumbnail) : '/img/demo.jpg' }}" height="50" alt="{{ $item->title }}">
                    </td>
                    
                    <td class="align-middle">
                      {{ $item->title}}
                    </td>
                    
                    <td class="text-center align-middle">
                      <form action="{{ route('delete-item', $item) }}" method="POST">
                        {{ csrf_field() }}
                        {{ method_field('DELETE')}}

                        <div class="btn-group">
                          <a href="{{ route('show-item', $item) }}" class="btn btn-sm btn-outline-secondary">
                            Show
                          </a>

                          <a href="{{ route('edit-item', $item) }}" class="btn btn-sm btn-outline-secondary">
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
          </div>
        @endif
      </div>
    </div>
  </section>
</div>
@endsection

@section('scripts')
    <script>
        $('#itemCategoryTab a').on('click', function (e) {
            e.preventDefault()
            $(this).tab('show')
        })
    </script>    
@endsection
