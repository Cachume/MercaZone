<?php
    require_once("./app/models/homemodel.php");
    class Home{

        public $products_more;
        public $products_reco;
        public function default(){
            $this->products_more = homeModel::getVendidos();
            if(isset($_SESSION['id_user'])){
                $this->products_reco= homeModel::getrecomendados($_SESSION['id_user']);
            }
            
            require_once("./app/views/home/index.php");
        }
    }
?>