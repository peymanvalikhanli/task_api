<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskLog extends Model
{
    protected $table = "task_log";
    protected $fillable = ['TaskID', 'UserID', 'Action', 'created_at', 'updated_at'];
}
