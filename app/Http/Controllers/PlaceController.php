<?php

namespace App\Http\Controllers;

use App\Models\City;
use App\Models\Place;
use App\Models\PlaceImage;
use Illuminate\Http\Request;

class PlaceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $places = Place::all();
        return view('backend.place.index',compact('places'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $cities = City::all();
        return view('backend.place.create',compact('cities'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'images' => 'required'
        ]);

        $place = new Place();
        $place->name = $request->name;
        $place->description = $request->description;
        $place->feature = $request->feature;
        $place->city_id = $request->city_id;
        $place->lat = $request->lat;
        $place->lng = $request->lng;
        if($request->hasFile('feature')){
            $data = $request->feature;
            $newName = time() . $data->getClientOriginalName();
            $data->move('place',$newName);
            $place->feature = 'place/' . $newName;
        }else{
            $place->feature = 'images/place.png';
        }
       
        $place->save();

        if($request->hasFile('images')){
            foreach($request->images as $image){
                $placeImage = new PlaceImage();
                $newName = $image->getClientOriginalName();
                $image->move('place',$newName);
                $placeImage->name = 'place/' . $newName;
                $placeImage->place_id = $place->id;
                $placeImage->save();
            }
        }

        $request->session()->flash('message','Record Saved');
        return redirect()->back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $cities = City::all();
        $place = Place::find($id);
        $images = PlaceImage::where('place_id',$id)->get();
        return view('backend.place.edit',compact('cities','place','images'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $data = $request->validate([
            'name' => 'required',
            'description' => 'required',
           
        ]);

        $place = Place::find($id);
        $place->name = $request->name;
        $place->description = $request->description;
        $place->feature = $request->feature;
        $place->city_id = $request->city_id;
        $place->lat = $request->lat;
        $place->lng = $request->lng;
        if($request->hasFile('feature')){
            $data = $request->feature;
            $newName = time() . $data->getClientOriginalName();
            $data->move('place',$newName);
            $place->feature = 'place/' . $newName;
        }
       
        $place->update();

        if($request->hasFile('images')){
            foreach($request->images as $image){
                $placeImage = new PlaceImage();
                $newName = $image->getClientOriginalName();
                $image->move('place',$newName);
                $placeImage->name = 'place/' . $newName;
                $placeImage->place_id = $place->id;
                $placeImage->save();
            }
        }

        $request->session()->flash('message','Record Saved');
        return redirect()->back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
