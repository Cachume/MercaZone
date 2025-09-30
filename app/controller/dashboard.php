<?php
class dashboard{
    public function default() {
        require_once './app/views/user/dashboard.php';
    }

    public function getMyProducts() {
        header('Content-Type: application/json');
        // header('Access-Control-Allow-Origin: *');
        // Simulación de productos obtenidos de la base de datos
        $products = ['success' => true, 'products' => [
            ['id' => 1, 'name' => 'Xbox Controller', 'category' => 'Accesorios', 'price' => 45, 'stock' => 10, 'image' => 'controller.png', 'view' => 45, 'sales' => 20],
            ['id' => 2, 'name' => 'Xbox Series X', 'category' => 'Consolas', 'price' => 400, 'stock' => 4, 'image' => 'xbox.png', 'view' => 45, 'sales' => 20]
        ]];
        echo json_encode($products);
    }

    public function getMyProduct(){
        header('Content-Type: application/json');
        header('Access-Control-Allow-Origin: *');
        $id = $_GET['id'] ?? null;
        // Simulación de un producto obtenido de la base de datos
        $products = ['success' => true, 'products' => [
            ['id' => 1, 'name' => 'Xbox Controller', 'category' => 'Accesorios', 'price' => 45, 'stock' => 10, 'image' => 'controller.png', 'view' => 45, 'sales' => 20, 'description' => 'Controlador inalámbrico para Xbox', 'short_description' => 'Controlador inalámbrico'],
            ['id' => 2, 'name' => 'Xbox Series X', 'category' => 'Consolas', 'price' => 400, 'stock' => 4, 'image' => 'xbox.png', 'view' => 45, 'sales' => 20, 'description' => 'La Xbox Series X es la consola más potente de Microsoft, ofreciendo un rendimiento excepcional y gráficos de última generación.', 'short_description' => 'Consola de videojuegos']
        ]];
        if($id !== null && isset($products['products'][$id - 1])) {
            echo json_encode(['success' => true, 'products' => [$products['products'][$id - 1]]]);
        } else {
            echo json_encode(['success' => false, 'message' => 'Producto no encontrado']);
        }
    }
}