<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Role;
use Illuminate\Http\Request;


class AdminUploadRoleController extends Controller
{
    public function index()
    {
        // Fetch all roles from the database
        $roles = Role::all(); // Adjust the query as necessary (e.g., paginate, filter)

        // Return the view and pass the roles variable
        return view('admin.adminroles', compact('roles')); // Use the correct view path
    }

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'role' => 'required|string|max:255',
            'role_desc' => 'required|string|max:500',
        ]);

        // Create a new role in the database
        Role::create([
            'role' => $validatedData['role'],
            'role_desc' => $validatedData['role_desc'],
        ]);

        // Redirect back with a success message
        return redirect()->back()->with('success', 'Role successfully added!');
    }
    public function update(Request $request, Role $role)
    {
        $validatedData = $request->validate([
            'role' => 'required|string|max:255',
            'role_desc' => 'required|string|max:500',
        ]);

        // Update the role in the database
        $role->update([
            'role' => $validatedData['role'],
            'role_desc' => $validatedData['role_desc'],
        ]);

        // Redirect back with success message
        return redirect()->back()->with('success', 'Role successfully updated!');
    }
}
