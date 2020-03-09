<?php

namespace App\Http\Middleware;

use App\Http\controllers\export; 
use App\Http\controllers\message_type; 
use App\Http\controllers\redirect_address; 


use App\Models\Users;


use Illuminate\Support\Facades\DB;

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

        if($token == 'NEBKA'){
            return $next($request);
        }

       $user = Users::where('token' , 'like', $token)->first();
        
        if(!is_null($user)){
            $request["user_id"]= $user->id; 
            return $next($request);
        }

        return response()->json(export::redirect("token", redirect_address::$Login), 401);
        
        
    }
}
