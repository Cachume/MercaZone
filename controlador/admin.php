<?php

    require_once("models/adminmodel.php");
    class AdminController{

        public $mensajes;
        public $verificaciones;
        public function __CONSTRUCT(){

            
        }
        public function default(){
            require('views/admin/index.php');
        }

        public function verificaciones(){
            $this->verificaciones = Adminmodel::getAllVerificaciones();
            require('views/admin/verificacion.php');
        }

         public function documentos(){
            if(isset($_GET['id'])){
                $usuarioId = $_GET['id'];
            } else {
                header("Location: index.php?u=admin&m=verificaciones");
                exit();
            }
            $verificacion = Adminmodel::getVerificacionByUserId($usuarioId);
            require('views/admin/documentos.php');
        }
    }
?>