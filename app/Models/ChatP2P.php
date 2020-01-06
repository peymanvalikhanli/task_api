<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ChatP2P extends Model
{
    protected $table = "chat_p2_p_s";
    protected $fillable = ['From', 'TO', 'Title', 'Content', 'ChatType', 'File', 'IsDelete', 'SeenDate'];
}
