<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Tymon\JWTAuth\Facades\JWTAuth;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Tymon\JWTAuth\Exceptions\JWTException;

class AuthController extends Controller
{

    public function register(Request $request){
        $validateData = $request->validate([
            'nama' => 'required',
            'username' => 'required',
            'password' => 'required',
            'role' => 'required',
            'nama_keluarga' => 'required',
        ]);

        $validateData['password'] = Hash::make($validateData['password']);
        $user = User::create($validateData);

        return response()->json($user,201);
    }
  public function login(Request $request){
    try{
        $validateData = Validator::make(
            $request->all(),
            [
                'username' => 'required',
                'password' => 'required'
            ]
        );

        if($validateData->fails()){
            return response()->json([
                'status' => false,
                'message' => 'validation error',
                'errors' => $validateData->errors()
            ],401);
        }

        if(!Auth::attempt(($request->only(['username','password'])))){
            return response()->json([
                'status' =>false,
                'message' => 'Something went really wrong!!!'
            ],401);
        }

        $user = User::where('username',$request->username)->first();

        return response()->json([
            'status' => true,
            'message' => 'Login berhasil',
            'token' => $user->createToken('API TOKEN')->plainTextToken
        ],200);
    } catch(\Throwable $th){
        return response()->json([
            'status' => false,
            'message' => $th->getMessage(),
        ],500);
    }
  }
       public function logout()
    {
       auth()->user()->tokens()->delete();
       
       return response()->json([
        'status' => true,
        'message' => 'Berhasil Logout',
        'data' => []
       ]);
    }
}
