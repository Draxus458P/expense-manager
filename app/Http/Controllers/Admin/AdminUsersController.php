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
    public function update(Request $request, User $user)
    {
        $validatedData = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|string|max:500',
            'role' => 'required|string|max:255',
        ]);

        // Update the role in the database
        $user->update([
            'name' => $validatedData['name'],
            'email' => $validatedData['email'],
            'role' => $validatedData['role'],
        ]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'User successfully updated!');
    }
    public function destroy($userId)
    {
        // Check if the role exists
        $user = User::find($userId);
        if (!$user) {
            return response()->json(['message' => 'User not found.'], 404);
        }

        $user->delete();

        return response()->json(['message' => 'User deleted successfully.'], 200);
    }
}
