<?php
    require_once './app/models/dashboardmodel.php';
    require_once './app/core/utils.php';
    require_once './app/core/mercamail.php';

class dashboard{
    public $data;
    public $comando;
    public $vef;
    public $mensaje;

    public function __construct(){
        // if(isset($_SESSION["id_user"]) == false){
        //     header("Location: /autenticarse");
        //     exit();
        // }
        // $userId = $_SESSION['id_user'];
        // $this->vef= Dashboardmodel::getUserVef($userId);
    }
    public function default() {
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
        $usuario_id = $_SESSION['id_user'] ?? null;
        $acepto = $_POST['acepto'] ?? null;
        if(is_null($acepto)){
            UtilsZone::instaMessage('error',"Error en la Verificación","Todos los campos son obligaroios");
            header('Location: ' . APP_URL . '/dashboard/verificacion');
            exit;
        }

        if(!isset($_FILES['cedula-front'])){
            UtilsZone::instaMessage('error',"Error en la Verificación","Todos los campos son obligaroios");
            header('Location: ' . APP_URL . '/dashboard/verificacion');
            exit;
        }
        $imagen = $_FILES['cedula-front'];
        $ext = strtolower(pathinfo($imagen['name'], PATHINFO_EXTENSION));
        $ext_permitidas = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
        if (!in_array($ext, $ext_permitidas)) {
            UtilsZone::instaMessage('error',"Error en la Verificación","Formato no permitido. Solo JPG, PNG, GIF o WEBP.");
            header('Location: ' . APP_URL . '/dashboard/verificacion');
            exit;
        } 

        if($imagen['size'] > 2*1024*1024){
            UtilsZone::instaMessage('error',"Error en la Verificación","La imagen de la cédula es demasiado grande (máx. 2 MB).");
            header('Location: ' . APP_URL . '/dashboard/verificacion');
            exit;
        } 
        $nombre = basename($imagen['name']);
        $upload_dir = 'assets/verificaciones/';
        $nombreSeguro = uniqid('img_', true) . '.' . $ext;
        $ruta=$upload_dir.$nombreSeguro;
        $data = [
            'user' => $_SESSION['id_user'],
            'image' => $ruta
        ];
        $messageMail="<div style='text-align: center; font-family: Arial, sans-serif;  padding: 50px 80px; width: 400px; margin: auto; border-radius: 10px; background-color: #f9f9f9;'>
        <h1>
            <span style='color:#00b45d;'>Merca<span style='color:#014651;'>Zone</span></span>
        </h1>
        <span style='text-decoration:none; font-weight: bold;'>Nos alegra saber que te quieres verificar.</span>
        <p>Has enviado correctamente tu información para la verificación</p>
        <p>Por los momentos solo queda <strong>esperar</strong> que el equipo de MercaZone compruebe tu información y concuerde con los datos que ingresaste en el registro</p>
        <p><strong>En caso que hayas ingresado tu información de forma incorrecta debes volver a llenar el formulario de verificación</strong></p>
        <p>Att: Equipo de MercaZone</p>
        </div>";
        if(move_uploaded_file($imagen['tmp_name'], $ruta)){
            $newvef = Dashboardmodel::NewVerification($data);
            if($newvef){
                MercaMail::sendMail($_SESSION['correo'],"MercaZone | Verificación de Identidad",$messageMail);
                UtilsZone::instaMessage('success    ',"Verificación Exitosa","Se ha subido exitosamente tu foto de verificación.");
                header('Location: ' . APP_URL . '/dashboard/verificacion');
                exit;    
            }else{
                UtilsZone::instaMessage('error',"Error en la Verificación","Ha ocurrido un error intentalo mas tarde.");
                header('Location: ' . APP_URL . '/dashboard/verificacion');
                exit;
            }
        }else{
            UtilsZone::instaMessage('error',"Error en la Verificación","Ha ocurrido un error intentalo mas tarde.");
            header('Location: ' . APP_URL . '/dashboard/verificacion');
            exit;
        }
    }

    public function getMaindata(){
        header("Access-Control-Allow-Origin: *");
        header("Access-Control-Allow-Headers: *");
        header("Access-Control-Allow-Methods: GET, POST, OPTIONS");
        header('Content-Type: application/json');
        $userId = $_SESSION['id_user'];
        $data = Dashboardmodel::getDashData($userId);
        echo json_encode(["success" => true, "data"=>$data]);

    }

    public function getProductosVendidos(){
        header('Content-Type: application/json');
        $userId = $_SESSION['id_user'];
        $data = Dashboardmodel::getSolds($userId);
        echo json_encode($data);
    }

    public function applydiscountuser(){
        header('Content-Type: application/json');
        $usuario_id = $_SESSION['id_user'] ?? null;
        $data = [
            'admin'=>$usuario_id,
            'user'=> $_POST['userId'],
            'discount'=> $_POST['porcentaje'],
            'note' => $_POST['nota']
        ];
        $descu= Dashboardmodel::setDiscount($data);
        if($descu){
            $message = "
                <div style='text-align: center; font-family: Arial, sans-serif; padding: 50px 80px; width: 400px; margin: auto; border-radius: 10px; background-color: #f9f9f9;'>
                    <h1>
                        <span style=\"color:#00b45d;\">Merca<span style=\"color:#014651;\">Zone</span></span>
                    </h1>

                    <span style='text-decoration:none; font-weight: bold;'>¡Buenas noticias!</span>

                    <p><strong> ".$_SESSION['nombre']." ".$_SESSION['apellidos']."</strong> de MercaZone te ha otorgado un <strong>descuento especial</strong>.</p>

                    <p>
                        <strong>Descuento:</strong> {$data['discount']}% <br>
                        <strong>Concepto:</strong> {$data['note']}
                    </p>

                    <p>Este descuento es <strong>válido para un solo uso</strong> y podrás aplicarlo al momento de pagar en tu próxima compra.</p>

                    <p><strong>Si no solicitaste este descuento o crees que se aplicó por error, contáctanos.</strong></p>

                    <p>Att: Equipo de MercaZone</p>
                </div>
                ";
            MercaMail::sendMail($_POST['useremail'],"MercaZone | Has recibido un Descuento Especial",$message);
            echo json_encode(["success" => true]);
        }else{
            echo json_encode(["success" => false]);
        }
        

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
}