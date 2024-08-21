<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;

class UserController extends Controller
{
    public function showProfile()
    {
        return view('profile.profile');
    }
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
    

    
    public function update(Request $request, $id)
    {
        $user = User::findOrFail($id);

        // Validasi field yang ada dalam request
        $request->validate([
            'nama' => 'sometimes|required|max:100',
            'email' => 'sometimes|required|email|unique:users,email,' . $user->id,
            'jabatan' => 'sometimes|required',
            'password' => 'sometimes|required',
        ]);

        // Update hanya field yang ada dalam request
        if ($request->filled('nama')) {
            $user->nama = $request->nama;
        }
        if ($request->filled('email')) {
            $user->email = $request->email;
        }
        if ($request->filled('jabatan')) {
            $user->jabatan = $request->jabatan;
        }
        if ($request->filled('password')) {
            $user->password = bcrypt($request->password);
        }

        $user->save();

        return response()->json(['message' => 'User updated successfully', 'user' => $user]);
    
        
    }

    public function destroy($id)
    {
        $user = User::findOrFail($id);
        $user->delete();

        return response()->json(['message' => 'User deleted successfully']);
    }

}
