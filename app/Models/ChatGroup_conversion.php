<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatGroup_conversion extends Model
{
    protected $table = "chat_group_conversions";
    protected $fillable = ['From', 'TO', 'Title', 'Content', 'ChatType', 'File', 'IsDelete', 'SeenDate'];
}
