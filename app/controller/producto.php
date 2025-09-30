<?php
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
    }

?>