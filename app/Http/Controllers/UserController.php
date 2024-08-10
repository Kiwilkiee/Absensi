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
            'role' => 'required|exists:roles,name', // Pastikan role ada dalam tabel roles
        ]);
    
        $user = User::create([
            'nama' => $request->nama,
            'email' => $request->email,
            'jabatan' => $request->jabatan,
            'password' => bcrypt($request->password),
            'role' => $request->role,
        ]);
    
        // Assign role to the user
        $user->assignRole($request->role);
    
        return response()->json(['user' => $user], 201);
    }
    

    public function update($id)
    {
        $user = User::findOrFail($id);

        $user->update([
            'nama' => request('nama'),
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
