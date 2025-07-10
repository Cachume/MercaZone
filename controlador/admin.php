<?php

    class AdminController{

        public $mensajes;
        public function __CONSTRUCT(){

            
        }
        public function default(){
            require('views/admin/index.php');
        }
    }
?>