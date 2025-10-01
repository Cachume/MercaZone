<?php
session_start();
$url = $_GET['url'] ?? 'home/default';
$urlParts = explode('/', trim($url, '/'));
$controller = $urlParts[0] ?? 'home';
$action     = $urlParts[1] ?? 'default';
$param      = $urlParts[2] ?? null;
$controllerFile = 'app/controller/' . $controller . '.php';
if (file_exists($controllerFile)) {
    require_once $controllerFile;
    $controller = new $controller();
    if (method_exists($controller, $action)) {
        call_user_func_array([$controller, $action], [$param]);
        exit();
    } else {
        $controller->default();
    }
 } else {
    echo "Error 404. Controlador no encontrado.";
}
?>