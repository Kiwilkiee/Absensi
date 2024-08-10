<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\user;
use Illuminate\Support\Facades\Auth;
use Tymon\JWTAuth\Facades\JWTAuth;

class AuthController extends Controller
{
    public function login(Request $request){
        {
            $credentials = $request->only('email', 'password');
    
            if (!$token = Auth::guard('api')->attempt($credentials)) {
                return response()->json(['error' => 'Unauthorized'], 401);
                

            }

            $user = Auth::guard('api')->user();
            $role = $user->roles->first()->name;
    
            return response()->json([
                'nama' => $user->nama,
                'user_id' => $user->id,
                'email' => $user->email,
                'jabatan' => $user->jabatan,
                'role' => $role,  
                'token' => $token
            ]);
        }
    

        
    }

    public function logout(Request $request) {

        Auth::logout();
        
       
        return response()->json(['message' => 'Logged out successfully']);
    }

    public function logoutAll(Request $request) {

        Auth::logout();
        // $request->user()->tokens()->delete();
        return response()->json(['message' => 'Logged out successfully']);
        
    }

    
}
