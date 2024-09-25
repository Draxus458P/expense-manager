<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\User;

class AdminUsersController extends Controller
{
    public function index()
    {
        // Fetch all roles from the database
        $users = User::all(); // Ensure to use the correct model name with an uppercase 'U'

        // Return the view and pass the roles variable
        return view('admin.adminusers', compact('users')); // Use the correct variable name
    }

    public function store(Request $request)
    {
        // Validate the incoming request data
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|email|max:255|unique:users',
            'role' => 'required|string|in:user,admin',
        ]);


        // Create a new user
        User::create([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'role' => $validatedData['role'],
            'password' => bcrypt('1234'),
        ]);

        return redirect()->back()->with('success', 'Role successfully added!');
    }
}
