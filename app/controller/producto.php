<?php
    require_once("./app/models/productmodel.php");
    class Producto{

        public function default(){
            header("location:/Mercazone/");
        }

        public function categoria($id=null){
            if($id!=null){
                $nombre = "Consolas";
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

    }

?>