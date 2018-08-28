<?php
namespace MVC\Classes ;

use MVC\Library\Session;

class Csrf
{
    public static function set()
    {
        $token = base64_encode(openssl_random_pseudo_bytes(64));
        Session::set('csrf', $token);
        return $token ;
    }

    public static function check($token)
    {
        if (Session::get('csrf') === $token) {
            return true;
        }
    }
}
