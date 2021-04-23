@extends('backend.app')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="/places/create" class="btn btn-primary btn-sm"><i class="nav-icon fas fa-plus-square"></i> Add New Places</a>
                    </div>
                    <div class="card-body">
                        <table class="table table-sm table-striped table-bordered" id="datatable">
                            <thead>
                                <tr>
                                    <th>#</th>
                                    <th>Place Name</th>
                                    <th>City</th>
                                    <th>lat</th>
                                    <th>lng</th>
                                    <th>Action</th>
                                </tr>
                            </thead>

                            <tbody>
                                @foreach ($places as $place)
                                    <tr>
                                        <td>{{ $place->id }}</td>
                                        <td>{{ $place->name }}</td>
                                        <td>{{ $place->city->name }}</td>
                                        <td>{{ $place->lat }}</td>
                                        <td>{{ $place->lng }}</td>
                                        <td>
                                            <a href="/places/{{ $place->id }}/edit">Edit</a>
                                        </td>
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