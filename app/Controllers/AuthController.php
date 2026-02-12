<?php
require_once '../core/Auth.php';
require_once '../app/Models/Employee.php';

class AuthController
{
    public function login()
    {
        require '../app/Views/auth/login.php';
    }

    public function authenticate()
    {
        $name = $_POST['name'] ?? '';
        $password = $_POST['password'] ?? '';

        $m = new Employee();
        $user = $m->findByName($name);

        if ($user && hash_equals((string)$user['password'], (string)$password)) {
            Auth::login($user);
            $token = urlencode(Auth::token());
            header("Location:?controller=Employee&action=index&token=" . $token);
            exit;
        }

        $error = 'ログインに失敗しました';
        require '../app/Views/auth/login.php';
    }

    public function logout()
    {
        Auth::logout();
        header("Location:?controller=Auth&action=login");
        exit;
    }
}
