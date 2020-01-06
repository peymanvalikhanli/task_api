<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatGroup extends Model
{
    protected $table = "";
    protected $fillable = ['Name', 'Owner', 'IsDelete'];
}
