<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskComment extends Model
{
    protected $table = "task_comment";
    protected $fillable = [ 'TaskID', 'UserID', 'Text', 'created_at', 'updated_at' ];
}
