<?php
namespace MVC\Library ;

class Session
{
    protected static $flash_message;
    protected static $is_logged_in = false;

    public static function setMessage($message)
    {
        $_SESSION['message'] = $message;
    }

    public static function hasMessage()
    {
        return isset($_SESSION['message']);
    }

    public static function message()
    {
        if (self::hasMessage()) {
            echo '<div class="">'.$_SESSION['message'].'</div>';
        }
        //delete self after message is sent
        self::delete('message');
    }

    public static function set($key, $value)
    {
        $_SESSION[$key] = $value;
    }
    public static function setMulti($key, $value)
    {
        $_SESSION[$key][] = $value ;
        //array_push($_SESSION[$key], $value);
    }

    public static function get($key)
    {
        if (isset($_SESSION[$key])) {
            return $_SESSION[$key];
        }
        return null;
    }

    public static function delete($key)
    {
        if (isset($_SESSION[$key])) {
            unset($_SESSION[$key]);
        }
    }

    //pulic static function unset($key)

    public static function remove($key, $index)
    {
        array_splice($_SESSION[$key], $index, 1);
    }

    public static function sessionSet($key)
    {
        return isset($_SESSION[$key]) ? true : false;
    }

    //clear certain items from the session
    public static function refresh()
    {
        //self::delete(name_of_session);
    }

    public static function destroy()
    {
        session_destroy();
    }
}
