@extends('backend.app')
@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="card">
                    <div class="card-header">
                        <a href="/places" class="btn btn-primary btn-sm"><i class="nav-icon fas fa-arrow-left"></i> Go Back</a>
                    </div>
                    <div class="card-body">
                        <form action="/places" method="post" enctype="multipart/form-data">
                            @csrf
                            <div class="form-group">
                                <label for="name">Place Name</label>
                                <input id="name" class="form-control" type="text" name="name" placeholder="City Name">
                            </div>

                            <div class="form-group">
                                <label for="description">Place Description</label>
                                <textarea id="description" class="form-control" name="description" rows="3"></textarea>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="city_id">Select City</label>
                                        <select id="city_id" class="form-control" name="city_id">
                                           @foreach ($cities as $city)
                                               <option value="{{ $city->id }}">{{ $city->name }}</option>
                                           @endforeach
                                        </select>
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="feature">Featured Image</label>
                                        <input id="feature" class="form-control-file" type="file" name="feature">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="images">Place Images</label>
                                        <input id="images" class="form-control-file" type="file" name="images[]" multiple max="5">
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="lat">Lat</label>
                                        <input id="lat" class="form-control" type="text" name="lat">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="lng">Lng</label>
                                        <input id="lng" class="form-control" type="text" name="lng">
                                    </div>
                                </div>
                            </div>
                            <button id="locationbtn"> btn</button>
                            <div id="mapid"></div>

                           
                            <button type="submit" class="btn btn-primary btn-sm"><i class="nav-icon fas fa-save"></i> Save Record</button>
                            
                        </form>

                        <div class="my-2">
                            @if (session('message'))
                                <div class="alert alert-success alert-sm">{{ session('message') }}</div>
                            @endif
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection