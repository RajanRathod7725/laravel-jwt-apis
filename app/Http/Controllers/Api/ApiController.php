<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Tymon\JWTAuth\Facades\JWTAuth;

class ApiController extends Controller
{
    //Register API
    public function register(Request $request){

        //Server Side Validation
        $request->validate([
            "name"=>"required",
            "email"=>"required|email|unique:users",
            "password"=>"required|confirmed"
        ]);

        //Save Data
        User::create([
            "name"=>$request->name,
            "email"=>$request->email,
            "password"=>Hash::make($request->password),
        ]);

        //Response
        return response()->json([
            'status'=>true,
            'message'=>"User created successfully!"
        ]);

    }

    //Login API
    public function login(Request $request){

        //Server Side Validation
        $request->validate([
            "email"=>"required|email",
            "password"=>"required"
        ]);

        //JWTAuth and Attempt
        $token = JWTAuth::attempt([
            "email"=>$request->email,
            "password"=>$request->password
        ]);

        //Check the token
        if(!empty($token)){
            //Response
            return response()->json([
                'status'=>true,
                'token'=> $token,
                'message'=>"Login successfully!"
            ]);
        }else{
            //Response
            return response()->json([
                'status'=>false,
                'message'=>"Invalid login details"
            ]);
        }

    }

    //Profile API
    public function profile(){

        //Data fetching
        $userData = auth()->user();

        //Response
        return response()->json([
            'status'=>true,
            'userData'=> $userData,
            'message'=>"Profile data get successfully!"
        ]);

    }

    //Refresh Tokan API
    public function refreshToken(){

        //Refresh the token
        $newToken = auth()->refresh();

        //Response
        return response()->json([
            "status"=>true,
            "message"=>"Token refresh successfully!",
            "token"=>$newToken
        ]);

    }

    //Logout API
    public function logout(){

        //Auth logout
        auth()->logout();

        //Response
        return response()->json([
            "status"=>true,
            "message"=>"Logout successfully!",
        ]);

    }
}
