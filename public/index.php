<?php
header('Content-Type: text/html; charset=UTF-8');
require_once '../core/Router.php';
$router=new Router();
$router->run();
?>
