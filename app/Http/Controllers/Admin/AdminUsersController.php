<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminUsersController extends Controller
{
    public function index()
    {
        return view('admin.adminusers'); // Ensure the path is correct
    }
}
