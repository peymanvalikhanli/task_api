<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Events\PostCreatedEvent;

use App\Http\controllers\export; 
use App\Http\controllers\message_type; 
use App\Http\controllers\redirect_address; 

class PostController extends Controller
{
    public function index()
    {
        // $event = new PostCreatedEvent(["name"=>"peyman"]);
        // event($event);
        // dd();
        return export::redirect("test", redirect_address::$home); 
    }
}
