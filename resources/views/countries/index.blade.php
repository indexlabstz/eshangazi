@extends('layouts.app')

@section('content')
<div class="card-body">
    <div class="d-flex justify-content-between flex-wrap flex-md-nowrap align-items-center pb-2 mb-3">
        <h1 class="h2">
            Countries
        </h1>

        <div class="btn-toolbar mb-2 mb-md-0">
            <div class="btn-group">
                <a href="{{ route('create-country') }}" class="btn btn-sm btn-outline-secondary">
                    New Country
                </a>
            </div>
        </div>
    </div>    

    <div class="table-responsive">
        @if($countries->isEmpty())
            <p class="lead text-muted">
                No data to display at the moment.
            </p>                

             <a href="{{ route('create-country') }}" class="btn btn-primary">
                Click here to add new Country
            </a>      
        @else
            <table class="table table-striped table-sm">
                <thead>
                    <tr>
                        <th>Name</th>
                        <th>Code</th>
                        <th>ISO</th>
                        <th class="text-center">Actions</th>
                    </tr>
                </thead>

                <tbody>
                    @foreach($countries as $country)
                        <tr>
                            <td class="align-middle">
                                {{ $country->name }}
                            </td>

                            <td class="align-middle">
                                {{ $country->code }}
                            </td>

                            <td class="align-middle">
                                {{ $country->iso }}
                            </td>

                            <td class="text-center align-middle">
                                <form action="{{ route('delete-country', $country) }}" method="POST">
                                    {{ csrf_field() }}
                                    {{ method_field('DELETE')}}

                                    <div class="btn-group">
                                        <a href="{{ route('show-country', $country) }}" class="btn btn-sm btn-outline-secondary">
                                            Show
                                        </a>

                                        <a href="{{ route('edit-country', $country) }}" class="btn btn-sm btn-outline-secondary">
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

            {{ $countries->links() }}
        @endif
    </div>
</div>
@endsection
