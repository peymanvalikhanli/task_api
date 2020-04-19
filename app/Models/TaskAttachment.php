<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskAttachment extends Model
{
    protected $table = "task_attachment";
    protected $fillable = ['id', 'TaskID', 'path', 'type', 'created_at', 'updated_at'];
}
