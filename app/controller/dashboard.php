<?php
        require_once './app/models/dashboardmodel.php';

class dashboard{
    public $data;
    public $comando;
    public $vef;
    public $mensaje;

    public function __construct(){
        if(isset($_SESSION["id_user"]) == false){
            header("Location: /MercaZone/autenticarse");
            exit();
        }
    }
    public function default() {
        $userId = $_SESSION['id_user'];
        $this->vef= Dashboardmodel::getUserVef($userId);
        $this->data = Dashboardmodel::getCategories();
        require_once './app/views/user/dashboard.php';
    }

    public function miscompras() {
        $comando= '
            $(".dashboard-main").hide();
            $(".dashboard-purchases").show();
            ChangeNameDashboard("link-purchases");
        ';
        $this->data = Dashboardmodel::getCategories();
        $this->comando = ['iscommand'=> true, 'command'=>$comando ];
        require_once './app/views/user/dashboard.php';
    }

    public function verificacion() {
        $comando= '
            $(".dashboard-main").hide();
            $(".dashboard-verification").show();
            ChangeNameDashboard("link-verification");
        ';
        $this->data = Dashboardmodel::getCategories();
        $this->comando = ['iscommand'=> true, 'command'=>$comando ];
        require_once './app/views/user/dashboard.php';
    }


    public function getMyProducts() {
        header('Content-Type: application/json');
        $userId = $_SESSION['id_user'];
        $products = Dashboardmodel::getMyProducts($userId);
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

    public function getChatMessage(){
        header('Content-Type: application/json');
        $userId = $_SESSION['id_user'];
        $data = json_decode(file_get_contents("php://input"), true);
        $order_id = $data['order_id'];
        $mensajes = Dashboardmodel::getAllMensages($order_id);
        if($mensajes){
            echo json_encode(['success' => true,'localuser' => $userId ,'messages' => $mensajes]);
        }else{
            echo json_encode(['success' => false,'messages' => $mensajes]);
        }
    }

    public function sendChatMessage(){
        header('Content-Type: application/json');
        $order_id = $_POST['order_id'] ?? null;
        $sender_id = $_SESSION['id_user'] ?? null;
        $message = trim($_POST['message'] ?? '');
        $mensajebd =Dashboardmodel::SendMensages($order_id,$sender_id,$message);
        if($mensajebd){
            echo json_encode(['success' => true]);
        }else{
            echo json_encode(['success' => false, 'mensaje' => $mensajebd]);
        }
    }

    public function getStatistics(){
        header('Content-Type: application/json');
        $userId = $_SESSION['id_user'];

    }

    public function verificarme(){
        // var_dump($_FILES);
        // echo "<br>";
        // var_dump($_POST);
        $usuario_id = $_SESSION['id_user'] ?? null;
        $acepto = $_POST['acepto'] ?? null;
        if(is_null($acepto)){
            echo "debes aceptar los terminos";
            $this->data = 'terminos';
            require_once './app/views/messages/messagesverificarme.php';
        }
        $upload_dir = 'assets/verificaciones/';
    }

    private function guardarArchivo($campo, $upload_dir) {
        if (isset($_FILES[$campo]) && $_FILES[$campo]['error'] === UPLOAD_ERR_OK) {
            $tmp = $_FILES[$campo]['tmp_name'];
            $nombre_archivo = uniqid() . '_' . basename($_FILES[$campo]['name']);
            $ruta = $upload_dir . $nombre_archivo;
            move_uploaded_file($tmp, $ruta);
            return $ruta;
        }
        return null;
    }

    public function mensaje($dato): void {
    $this->data = $dato;
    require_once './app/views/messages/messagesverificarme.php';
}
}