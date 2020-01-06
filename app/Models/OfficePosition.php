<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class OfficePosition extends Model
{
    protected $table = "office_positions";
    protected $fillable = [
     'Name'
    ];
}
