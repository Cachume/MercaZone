<?php
    require_once("./app/models/homemodel.php");
    class Home{

        public $products_more;
        public function default(){
            $this->products_more = homeModel::getVendidos();
            require_once("./app/views/home/index.php");
        }
    }
?>