<?php
    require_once("models/perfilmodel.php");
    class PerfilController{

        public $mensajes;
        public $verificacion;
        public function __CONSTRUCT(){  
            if(!isset($_SESSION['id_user'])) {
            $this->mensajes[] = "Usuario no autenticado.";
            header("Location: index.php?u=auth");
            exit();
        }
        }
        public function default(){
            $this->verificacion = PerfilModel::GetVerificacion(["usuario_id" => $_SESSION['id_user']]);
            require('views/user/perfil.php');
        }
    }
?>