<?php
    require_once("./app/models/productmodel.php");
    class Producto{
        public $product_data;

        public function default(){
            header("location:/");
            // $url = $_GET['url'] ?? 'home/default';
            // $urlParts = explode('/', trim($url, '/'));
            // $producto = $urlParts[1];
            // $this->product_data = Productmodel::getOneProduct($producto);
            // var_dump($this->product_data);    
            // require_once './app/views/products/producto.php';
        }

        public function categoria($id=null){
            if($id!=null){
                $nombre = "Consolas";
                $user = $_SESSION['id_user'] ?? null;
                $products = Productmodel::getProductsByCategory($id, $user);
                $totalProducts = Productmodel::getProductsByCategorycount($id);
                $nombre = $products[0]['categoria'] ?? 'Categoría';
                require_once './app/views/products/category.php';
            }else{
                header("location:/");
            }
        }

        public function get_product(){
            header('Content-Type: application/json');
            if(isset($_GET['producto'])){
                $id = $_GET['producto'] ?? null;
                if($id!=null){
                    $producto = Productmodel::getOneProduct($id);
                    if($producto){
                        echo json_encode(['success'=>true,'data'=>$producto]);
                    }else{
                        echo json_encode(['success'=>false,'message'=>'Producto no encontrado']);
                    }
                }
            }else{
                echo json_encode(['success'=>false,'message'=>'No se ha especificado el producto']);
            }
        }

        public function buyProduct(){
            header('Content-Type: application/json');
            $input = json_decode(file_get_contents('php://input'), true);
            if(isset($input['id']) && isset($input['cantidad'])){
                $data = [
                    'id' => $input['id'],
                    'cantidad' => $input['cantidad'],
                    'usuario' => $_SESSION['id_user']
                ];
                $result = Productmodel::buyProduct($data);
                echo json_encode($result);
                return;
            }
            echo json_encode(['success'=>false,'message'=>'Función en desarrollo']);
        }
    }

?>