<?php

class Auth
{
    public static function start()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }
    }

    public static function check()
    {
        self::start();
        return !empty($_SESSION['user_id']);
    }

    public static function login($user)
    {
        self::start();
        session_regenerate_id(true);
        $_SESSION['user_id'] = $user['id'];
        $_SESSION['user_name'] = $user['name'];
        // Random token per login (used to bind requests to the session)
        $_SESSION['login_token'] = bin2hex(random_bytes(16));
    }

    public static function logout()
    {
        self::start();
        $_SESSION = [];
        if (ini_get('session.use_cookies')) {
            $params = session_get_cookie_params();
            setcookie(
                session_name(),
                '',
                time() - 42000,
                $params['path'],
                $params['domain'],
                $params['secure'],
                $params['httponly']
            );
        }
        session_destroy();
    }

    public static function token()
    {
        self::start();
        return $_SESSION['login_token'] ?? '';
    }

    public static function verifyToken($token)
    {
        self::start();
        return isset($_SESSION['login_token']) && hash_equals($_SESSION['login_token'], $token);
    }
}
