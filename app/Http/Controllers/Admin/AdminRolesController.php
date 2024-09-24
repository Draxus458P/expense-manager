<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminRolesController extends Controller
{
    public function index()
    {
        return view('admin.adminroles');
    }
}
