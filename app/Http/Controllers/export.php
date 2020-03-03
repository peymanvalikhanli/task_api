<?php

namespace App\Http\Controllers;

class redirect_address{
    public $Login = "Login";
    public $home = "Home";
}

class export {

    public static function data($act, $data, $type = null){
        if (is_null($type)){
        return array(act => $act , data =>$data);
        }else{
            return array(act => $act , data =>$data , type => $type);
        }
    }

    public static function message($type,$title,$text, $btn = "OK"){
        $data = array( title => $title , text => $text , btn=> $btn );
        return self::data("messege", $data, $type);
    }

    public static function redirect( $act ,  redirect_address $address){
        return array(act => $act , redirect=> $address);
    }

}
