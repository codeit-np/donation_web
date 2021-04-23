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
                                <input id="name" class="form-control" type="text" name="name" placeholder="City Name" value="{{ $place->name }}">
                            </div>

                            <div class="form-group">
                                <label for="description">Place Description</label>
                                <textarea id="description" class="form-control" name="description" rows="3">{{ $place->description }}</textarea>
                            </div>

                            <div class="row">
                                <div class="col">
                                    <div class="form-group">
                                        <label for="city_id">Select City</label>
                                        <select id="city_id" class="form-control" name="city_id">
                                           @foreach ($cities as $city)
                                               <option value="{{ $city->id }}" {{ $city->id == $place->city_id ? 'selected' : '' }}>{{ $city->name }}</option>
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
                                        <input id="lat" class="form-control" type="text" name="lat" value="{{ $place->lat }}">
                                    </div>
                                </div>

                                <div class="col">
                                    <div class="form-group">
                                        <label for="lng">Lng</label>
                                        <input id="lng" class="form-control" type="text" name="lng" value="{{ $place->lng }}">
                                    </div>
                                </div>
                            </div>
                            <button id="locationbtn" class="my-2">Current Location</button>
                            <div id="mapid"></div>

                           
                            <button type="submit" class="btn btn-primary btn-sm mt-2"><i class="nav-icon fas fa-sync"></i> Update Record</button>
                         
                            
                        </form>

                        <label for="">Featured</label>
                        <div class="my-2">
                           <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $place->id }}"><img src="{{ asset($place->feature) }}" width="100" class="rounded" alt=""></a> 
                            <!-- Modal -->
                            <div class="modal fade" id="exampleModal{{ $place->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                <div class="modal-dialog">
                                <div class="modal-content">
                                    <div class="modal-body">
                                        <img src="{{ asset($place->feature) }}" width="w-100" class="rounded" alt="">
                                    </div>
                                </div>
                                </div>
                            </div>
                        </div>

                        <label for="">Place images</label>
                        <div class="my-2">
                            @foreach ($images as $image)
                            <a href="" data-bs-toggle="modal" data-bs-target="#exampleModal{{ $image->id }}"> <img src="{{ asset($image->name) }}" width="50" class="rounded" alt=""></a>
                               

                                <!-- Modal -->
                                <div class="modal fade" id="exampleModal{{ $image->id }}" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                                    <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-body">
                                            <img src="{{ asset($image->name) }}" width="w-100" class="rounded" alt="">
                                        </div>
                                    </div>
                                    </div>
                                </div>
                            @endforeach
                        </div>

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