<?php

class Session
{
    public function __construct()
    {
        session_start();
    }

    public function setSession($key, $value)
    {
        $_SESSION[$key] = $value;
    }


    /**
     * @param string $key
     * @return mixed
     */
    public function getSession($key = '')
    {
        if (! empty($key)) {
            if (isset($_SESSION[$key])) {
                return $_SESSION[$key];
            }
        }
        return '';
    }

    /**
     * @param string $key
     * @return bool
     */
    public function clearSession($key = '')
    {
        if (! empty($key)) {
            unset($_SESSION[$key]);
            if (empty($_SESSION[$key])) {
                return true;
            }
        }
        return false;
    }
}
