<?php
require_once __DIR__ . '/Auth.php';

class Router
{
    public function run()
    {
        Auth::start();

        $controller = $_GET['controller'] ?? 'Employee';
        $action = $_GET['action'] ?? 'index';

        $publicActions = ['login', 'authenticate'];
        $isAuthController = ($controller === 'Auth');

        if (!Auth::check() && !($isAuthController && in_array($action, $publicActions, true))) {
            header("Location:?controller=Auth&action=login");
            exit;
        }

        if (Auth::check() && !($isAuthController && in_array($action, $publicActions, true))) {
            $token = $_SERVER['REQUEST_METHOD'] === 'POST'
                ? ($_POST['token'] ?? '')
                : ($_GET['token'] ?? '');

            if (!Auth::verifyToken($token)) {
                http_response_code(403);
                echo 'Invalid token';
                exit;
            }
        }

        $class = $controller.'Controller';

        require_once dirname(__DIR__) . '/app/Controllers/' . $class . '.php';

        $controller = new $class();
        $controller->$action();
    }
}
?>
