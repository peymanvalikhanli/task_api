<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Users extends Model
{
    protected $table= "users";
    protected $fillable = [
        'UserName',
        'Password',
        'email',
        'name', 
        'Avatar',
        'token',
        'UserID',
        'OfficePosition',
        'ServerRef',
        'LastLogin',
        'IsOnline'
    ];
}
