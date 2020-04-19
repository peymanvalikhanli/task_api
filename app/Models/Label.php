<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Label extends Model
{
    protected $table = "label";
    protected $fillable = [ 'id', 'name', 'color'];
}
