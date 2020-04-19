<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class TaskLabel extends Model
{
    protected $table = "task_label";
    protected $fillable = ['TaskID', 'LabelID'];
}
