<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskMember extends Model
{
    protected $table = "task_member";
    protected $fillable = ['TaskID', 'UserID'];
}
