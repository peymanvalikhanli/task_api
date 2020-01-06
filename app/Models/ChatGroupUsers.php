<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatGroupUsers extends Model
{
    protected $table =  "chat_group__users";
    protected $fillable =['ChatGroupID', 'UserID', 'Permission', 'RemoveFromGroup', 'RemoveBy', 'RemoveDate', 'LeaveGroup', 'LeaveDate'];
}
