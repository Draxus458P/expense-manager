<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;

class AdminExpensesController extends Controller
{
    public function index()
    {
        return view('admin.adminexpenses'); // Ensure the path is correct
    }
}
