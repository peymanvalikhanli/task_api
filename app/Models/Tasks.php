<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Tasks extends Model
{
    protected $table = "tasks";
    protected $fillable = ['id', 'name', 'Dsc', 'Stat', 'CheckLists', 'DueDate','CreatedBy', 'created_at', 'updated_at'];
    
}
