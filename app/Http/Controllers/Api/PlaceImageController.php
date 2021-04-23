<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\PlaceImage;
use Illuminate\Http\Request;

class PlaceImageController extends Controller
{
    public function getImages(Request $request)
    {
    
        $images = PlaceImage::where('place_id',$request->place_id)->get();
        return response()->json($images);
    }
}
