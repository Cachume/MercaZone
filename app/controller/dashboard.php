<?php
        require_once './app/models/dashboardmodel.php';

class dashboard{
    public $data;

    public function __construct(){
        if(isset($_SESSION["id_user"]) == false){
            header("Location: /MercaZone/autenticarse");
            exit();
        }
    }
    public function default() {
        $this->data = Dashboardmodel::getCategories();
        require_once './app/views/user/dashboard.php';
    }

    public function getMyProducts() {
        header('Content-Type: application/json');
        // header('Access-Control-Allow-Origin: *');
        // Simulación de productos obtenidos de la base de datos
        $userId = $_SESSION['id_user'];
        $products = Dashboardmodel::getMyProducts($userId);
        // $products = ['success' => true, 'products' => [
        //     ['id' => 1, 'name' => 'Xbox Controller', 'category' => 'Accesorios', 'price' => 45, 'stock' => 10, 'image' => 'controller.png', 'view' => 45, 'sales' => 20],
        //     ['id' => 2, 'name' => 'Xbox Series X', 'category' => 'Consolas', 'price' => 400, 'stock' => 4, 'image' => 'xbox.png', 'view' => 45, 'sales' => 20]
        // ]];
        $products = ['success' => true, 'products' => $products];
        echo json_encode($products);
    }

    public function getMyProduct(){
        header('Content-Type: application/json');
        $userId = $_GET['id_product'];
        $product = Dashboardmodel::getMyProduct($userId);
        echo json_encode(['success' => true, 'product' => $product]);
    }

    public function getMyPurchases(){
        header('Content-Type: application/json');
        $userId = $_SESSION['id_user'];
        $purchases = Dashboardmodel::getMyPurchases($userId);
        echo json_encode(['success' => true, 'purchases' => $purchases]);
    }

    public function getMyOrders(){
        header('Content-Type: application/json');
        $userId = $_SESSION['id_user'];
        $orders = Dashboardmodel::getMyOrders($userId);
        echo json_encode(['success' => true, 'orders' => $orders]);
    }

    public function addProduct(){
        header('Content-Type: application/json');
        $userId = $_SESSION['id_user'];
        $data = [
            'name' => $_POST['product-name'] ?? null    ,
            'description' => $_POST['product-description'] ?? null  ,
            'price' => $_POST['product-price'] ?? null  ,
            'stock' => $_POST['product-stock'] ?? null  ,
            'category' => $_POST['product-category'] ?? null    ,
            'image' => $_FILES['product-image']['name'] ?? null  ,
            'full_description' => $_POST['product-full-description'] ?? null    ,
            'userId' => $userId
        ];
        $this->uploadImage($_FILES['product-image']);
        $product = Dashboardmodel::addProduct($data);
        echo json_encode($product);
        return;
    }

    public function uploadImage($file){
        $targetDir = "assets/img/products/";
        $targetFile = $targetDir . basename($file["name"]);
        $imageFileType = strtolower(pathinfo($targetFile,PATHINFO_EXTENSION));
        $check = getimagesize($file["tmp_name"]);
        if($check !== false) {
            if (move_uploaded_file($file["tmp_name"], $targetFile)) {
                return $file["name"];
            } else {
                return null;
            }
        } else {
            return null;
        }
    }
}