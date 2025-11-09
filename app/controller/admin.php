<?php

    require_once("./app/models/adminmodel.php");
    class Admin{

        public $mensajes;
        public $verificaciones;
        public function __CONSTRUCT(){

            
        }
        public function default(){
            require('./app/views/admin/index.php');
        }

        public function usuarios(){
            require('./app/views/admin/usuarios.php');
        }

        public function verificaciones(){
            require('./app/views/admin/verificaciones.php');
        }
        public function getUsers(){
        header('Content-Type: application/json');
        $users = Adminmodel::getUsers();
        echo json_encode(['success' => true, 'product' => $users]);
        }

        public function getVerificaciones(){
        header('Content-Type: application/json');
        $users = Adminmodel::getAllVerificaciones();
        echo json_encode(['success' => true, 'product' => $users]);
        }

        // public function verificaciones(){
        //     $this->verificaciones = Adminmodel::getAllVerificaciones();
        //     require('views/admin/verificacion.php');
        // }

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