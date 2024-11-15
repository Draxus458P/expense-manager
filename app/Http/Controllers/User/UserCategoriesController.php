<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;

class UserCategoriesController extends Controller
{
    public function index()
    {
        return view('user.usercategories');
    }
}
