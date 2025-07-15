<?php
session_start();
// include 'modelo/conexiondb.php';
// Enrutamiento
$controllerName = isset($_GET['u']) ? $_GET['u'] : 'index';
$method = isset($_GET['m']) ? $_GET['m'] : 'default';

// Mapeo de rutas a controladores
$controllers = [
    'index' => 'IndexController',
    'auth' => 'AuthController',
    'verificacion' => 'VerificacionController',
    'inicio' => 'LoginController',
    'registro' => 'RegisController',
    'perfil' => 'PerfilController',
    'seccion' => 'SeccionController',
    'admin' => 'AdminController',
    'baneado' => 'baneadoController',
    'manual' => 'ManualController'
];

// Verificar si la ruta solicitada existe en el mapeo
if (array_key_exists($controllerName, $controllers)) {
    $controllerClass = $controllers[$controllerName];
    $controllerFile = 'controlador/' . $controllerName . '.php';

    if (file_exists($controllerFile)) {
        require_once $controllerFile;
        $controller = new $controllerClass();

        if (method_exists($controller, $method)) {
            $controller->$method();
            exit();
        } else {
            echo "Error 404. Método no encontrado.";
        }
    } else {
        echo "Error 404. Controlador no encontrado.";
    }
} else {
    echo "Error 404. Ruta no encontrada.";
}
?>