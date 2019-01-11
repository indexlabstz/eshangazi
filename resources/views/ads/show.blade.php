@extends('layouts.app')

@section('content')
  <div class="card-body">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3 border-bottom">
      <h1 class="h2">
        Ad Details
      </h1>

      <div class="btn-toolbar mb-2 mb-md-0">
        <div class="btn-group">
          <a href="{{ route('index-ad') }}" class="btn btn-sm btn-outline-secondary">
            Ads List
          </a>
        </div>
      </div>
    </div>

    <section class="jumbotron">
      <h1 class="jumbotron-heading">
        {{ $ad->title }}
      </h1>

      <p class="lead text-muted">
        {{ $ad->description }}
      </p>

      <p class="card-text">
        <small class="text-muted">
          Created by:
          <a href="#">
            {{ $ad->creator->name }}
          </a>

          {{ $ad->created_at->diffForHumans() }}
        </small>
      </p>
    </section>

    <section class="relation">
      <ul class="nav nav-tabs" id="adTab" role="tablist">
        <li class="nav-item">
          <a class="nav-link active" id="details-tab" data-toggle="tab" href="#details" role="tab" aria-controls="details" aria-selected="true">
            Payments
          </a>
        </li>
      </ul>

      <div class="tab-content" id="adTabRelation">
        <div class="tab-pane fade show active" id="details" role="tabpanel" aria-labelledby="details-tab">
          <div class="table-responsive">
            @if($ad->payments->isEmpty())
              <p class="lead text-muted">
                No data to display at the moment.
              </p>
            @else
              <table class="table table-striped table-sm">
                <thead>
                  <tr>
                    <th>Reference</th>

                    <th>Status</th>

                    <th class="text-center">Actions</th>
                  </tr>
                </thead>

                <tbody>
                  @foreach($ad->payments as $detail)
                    <tr>

                      <td class="align-middle">
                        {{ $detail->reference }}
                      </td>

                      <td class="align-middle">
                        {{ $detail->status }}
                      </td>

                    </tr>
                  @endforeach
                </tbody>
              </table>
            @endif
          </div>
        </div>
      </div>
    </section>
  </div>
@endsection

@section('scripts')
  <script>
      $('#adTab a').on('click', function (e) {
          e.preventDefault()
          $(this).tab('show')
      })
  </script>
@endsection
