<?php
session_start();
require_once __DIR__.'/vendor/autoload.php';
$dotenv= Dotenv\Dotenv::createImmutable(__DIR__);
$dotenv->load();

define('APP_URL', $_ENV['APP_URL']);
define('APP_ENV', $_ENV['APP_ENV']);
define('SMTP_USER', $_ENV['SMTP_USER']);
define('SMTP_PASSWORD', $_ENV['SMTP_PASSWORD']);

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