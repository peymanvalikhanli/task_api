<?php

namespace App\Http\Controllers\Users;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Illuminate\Support\Facades\Hash;
use App\Models\Users;

use Illuminate\Support\Facades\DB;

use App\Http\controllers\export; 
use App\Http\controllers\message_type; 
use App\Http\controllers\redirect_address; 

class globalController extends Controller
{
    //
    public function register(Request $request)
    {
        try{
            $request["Password"] = Hash::make($request->Password);
            $token = Hash::make($request->email);
            $request["token"] = $token; 
            $user = Users::create($request->all());
            $result = export::data("Register", ["token"=>$user->token , "name"=> $user->name, "avatar"=> $user->avatar, "email"=> $user->email]);               
            return response()->json($result, 201);
        }catch(\Exception $exception){
            $result = export::message(message_type::$error,"Error",$exception);               
            return response()->json($result, 400);
        }  
    }
    public function login(Request $request)
    {
        $column = 'email'; // This is the name of the column you wish to search
        $user = Users::where($column , '=', $request->email)->first();
        if(isset($user->email)){
            if (Hash::check($request->Password, $user->Password)) {
                $result = export::data("Login", ["token"=>$user->token , "name"=> $user->name, "avatar"=> $user->avatar, "email"=> $user->email]);               
                return response()->json($result, 200);
            }
            $result = export::message(message_type::$error,"Error","invalid Password! ");               
            return response()->json($result, 401);    
        }   
        $result = export::message(message_type::$error,"Error","invalid Username! ");               
        return response()->json($result, 401);      
    }
    
    public function contact_list()
    {
        $result = export::data("Login", ["token"=>$user->token , "name"=> $user->name, "avatar"=> $user->avatar, "email"=> $user->email]);               
        return response()->json($result, 200);
        
    }

    
}
