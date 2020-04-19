<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class StatTask extends Model
{
    protected $table = "stat_task";
    protected $fillable = ['id', 'name'];
}
