<?php 

namespace App\Http\Controllers;

class redirect_address{
    public $Login = "Login";
    public $home = "Home"; 
}

class export {

    public static function data($act, $data, $type = null){
        if (is_null($type)){ 
        return array(act=> $act , data=>$data);
        }else{
            return array(act=> $act , data=>$data);
        } 
    }

    public static function message($type,$title,$text, $btn = "OK"){
        // return self->data("")
    }

    public static function redirect(redirect_address $address){

    }

}