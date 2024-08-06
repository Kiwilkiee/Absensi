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

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);

        if (Auth::attempt(['email' => $request->email, 'password' => $request->password])) {
            $user = Auth::user();
            $token = JWTAuth::fromUser($user);

            return response()->json([
                'success'       => true,
                'email'         => $user->email,
                'jabatan'       => $user->jabatan,
                'token'          => $token
            ], 201);

            return response()->json(['error' => 'Data Tidak Di temukan Silahkan Cek Kembali'], 400);
        } 
    }

    
}
