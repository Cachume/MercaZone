<?php
    require_once("models/perfilmodel.php");
    class PerfilController{

        public $mensajes;
        public $verificacion;
        public function __CONSTRUCT(){  
        }
        public function default(){
            $this->verificacion = PerfilModel::GetVerificacion(["usuario_id" => $_SESSION['id_user']]);
            require('views/user/perfil.php');
        }
    }
?>