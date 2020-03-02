<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Events\PostCreatedEvent; 


class PostController extends Controller
{
    public function index()
    {
        $event = new PostCreatedEvent(["name"=>"peyman"]); 
        event($event); 
        dd(); 
    }
}
