<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function index()
    {
        $users = User::all();
        return response()->json($users);
    }

    public function store(Request $request)
    {
        $request->validate([
            'nama' => 'required|max:100',
            'email' => 'required|email|unique:users',
            'jabatan' => 'required',
            'password' => 'required',
        ]);

        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'jabatan' => $request->jabatan,
            'password' => bcrypt($request->password),
        ]);

        return response()->json(['user' => $user], 201);
    }

    public function update($id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'name' => request('name'),
            'email' => request('email'),
            'jabatan' => request('jabatan'),
            
        ]);
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }

}
