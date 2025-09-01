<?php
class DashboardController {
    public function default() {
        require_once 'vista/dashboard.php';
    }

    public function getMyProducts() {
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        // Simulación de productos obtenidos de la base de datos
        $products = ['success' => true, 'products' => [
            ['id' => 1, 'name' => 'Xbox Controller', 'category' => 'Accesorios', 'price' => 45, 'stock' => 10, 'image' => 'controller.png', 'view' => 45, 'sales' => 20],
            ['id' => 2, 'name' => 'Xbox Series X', 'category' => 'Consolas', 'price' => 400, 'stock' => 4, 'image' => 'xbox.png', 'view' => 45, 'sales' => 20]
        ]];
        echo json_encode($products);
    }
}