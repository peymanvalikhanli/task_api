<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatPermission extends Model
{
    protected $table = "chat_permissions";
    protected $fillable = ['Name'];
}
