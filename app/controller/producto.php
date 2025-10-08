<?php
    require_once("./app/models/productmodel.php");
    class Producto{

        public function default(){
            header("location:/Mercazone/");
        }

        public function categoria($id=null){
            if($id!=null){
                $nombre = "Consolas";
                $products = Productmodel::getProductsByCategory($id);
                $totalProducts = Productmodel::getProductsByCategorycount($id);
                $nombre = $products[0]['categoria'] ?? 'Categoría';
                require_once './app/views/products/category.php';
            }else{
                echo "todo nulo";
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