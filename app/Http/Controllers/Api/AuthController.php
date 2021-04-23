<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class AuthController extends Controller
{
    // Register

    public function register(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'name' => 'required',
            'email' => 'required',
            'password' => 'required',
            'address' => 'required',
            'mobile' => 'required',
           
        ]); 

        if($validator->fails()){
            return response()->json([
                'message' => 'Bad Request'
            ],400);
        }

        $user = new User();
        $user->name = $request->name;
        $user->email = $request->email;
        $user->password = Hash::make($request->password);
        $user->is_admin = 0;
        $user->address = $request->address;
        $user->mobile = $request->mobile;
        $user->save();
        return response()->json([
            'message' => 'success'
        ],200);
    }

    // Login

    public function login(Request $request)
    {
        $validator = Validator::make($request->all(),[
            'email' => 'required|email',
            'password' => 'required',
        ]);

        if($validator->fails()){
            return response()->json([
                'message' => 'Bad Request'
            ],400);
        }

        $credintials = request(['email','password']);

        if(!Auth::attempt($credintials)){
            return response()->json([
                
                'message' => 'Unauthorized'
            ],500);
        }

        $user = User::where('email',$request->email)->first();

        $tokenResult = $user->createToken('authToken')->plainTextToken;

        return response()->json([
            'message' => 'success',
            'token' => $tokenResult
        ],200);
    }

    // Logout

    public function logout(Request $request)
    {
        $request->user()->currentAccessToken()->delete();
        return response()->json([
            'code' => 200,
            'message' => 'success'
        ]);
    }

    public function update(Request $request,$id)
    {
        // return response()->json(['message' => 'sajal']);
        $user = User::find($id);
        $user->name = $request->name;
        $user->address = $request->address;
        $user->mobile = $request->mobile;
        if($request->hasFile('photo')){
            $data = $request->photo;
            $newName = time() . $data->getClientOriginalName();
            $data->move('photo',$newName);
            $user->photo = 'photo/' . $newName;
         }
        $user->update();
        return response()->json([
            'message' => 'success'
        ],200);
    }

    public function changePassword(Request $request)
    {
        $user = User::find($request->user()->id);
        $user->name = $request->name;
        $user->update();
        return response()->json([
            'message' => 'success'
        ],200);
    }
}
