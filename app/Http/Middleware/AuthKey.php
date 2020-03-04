<?php

namespace App\Http\Middleware;

use App\Http\controllers\export; 
use App\Http\controllers\message_type; 
use App\Http\controllers\redirect_address; 


use App\Models\Users;

use Closure;

class AuthKey
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        $token = $request->header('X-CSRF-TOKEN'); 
        if(is_null($token) || $token == ""){
            return response()->json(export::message(message_type::$error,404,"Not found API..."), 404);
        }
        if($token == '$2y$10$GZ3RAYAobp6Ms0PgxfILIuoXnMpt0LVnQOPD5/.RY7GkO9tAp4IRC'){
            return $next($request);
        }

        $column = 'token'; // This is the name of the column you wish to search
        $user = Users::where($column , '=', $token)->first();
        if(is_numeric($user->id)){
            $request["user_id"]= $user->id; 
            return $next($request);
        }

        return response()->json(export::redirect("token", redirect_address::$Login), 401);
        
        
    }
}
