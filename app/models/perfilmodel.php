<?php
    require_once("mzDb.php");
    class Perfilmodel extends MzDB {

        public static function  GetVerificacion($data){
            $db = MzDB::conectar();       
            if (!$db) {
                return false;
            } else {
                $stmt= $db->prepare("SELECT * FROM verificaciones WHERE usuario_id = :usuario_id");
                $stmt->bindParam(":usuario_id", $data["usuario_id"], PDO::PARAM_INT);
                $stmt->execute();
                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                $estado_verificacion = $resultado['estado'] ?? null;
                return $estado_verificacion;
            }
        }
    }

?>