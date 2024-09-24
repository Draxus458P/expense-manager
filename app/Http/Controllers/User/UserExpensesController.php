<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class UserExpensesController extends Controller
{
    public function index()
    {
        return view('user.userexpenses'); // Ensure the path is correct
    }
}
