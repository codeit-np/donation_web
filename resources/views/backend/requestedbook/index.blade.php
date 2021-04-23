@extends('backend.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                       Requested Book
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-striped table-bordered" id="datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Book Name</th>
                                    <th>Category</th>
                                    <th>Remars</th>
                                    <th>On</th>
                                    <th>Request By</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($requestedbook as $requestedbook)
                                    <tr>
                                        <td>{{ $requestedbook->id }}</td>
                                        <td>{{ $requestedbook->name }}</td>
                                        <td>{{ $requestedbook->category->name }}</td>
                                        <td>{{ $requestedbook->remarks }}</td>
                                        <td>{{ $requestedbook->created_at->diffForHumans() }}</td>
                                        <td>{{ $requestedbook->user->name }}</td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection