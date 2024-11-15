<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Role extends Model
{
    // Specify the table name if it's not the default 'roles'
    protected $table = 'roles';

    // Define the fillable fields
    protected $fillable = [
        'role',
        'role_desc',
    ];
}
