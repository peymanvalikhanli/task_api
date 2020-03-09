<?php

namespace App\Http\Controllers;

class redirect_address
{
    public static $Login = "Login";
    public static $home = "Home";
}

class message_type
{
    public static $error = "error";
    public static $message = "message";
    public static $warning = "warning";
    public static $info = "info";
}

class export
{

    public static function data($act, $data, $type = null)
    {
        if (is_null($type)) {
            return array("act" => $act, "data" => $data);
        } else {
            return array("act" => $act, "data" => $data, "type" => $type);
        }
    }

    public static function message($type, $title, $text, $btn = "OK")
    {
        $data = array("title" => $title, "text" => $text, "btn" => $btn);
        return self::data("message", $data, $type);
    }

    public static function redirect($act, $address)
    {
        return array("act" => $act, "redirect" => $address);
    }
}
