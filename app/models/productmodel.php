<?php
    require_once("mzDb.php");
    class Productmodel extends MzDB {

        public static function  getOneProduct($id){
            $db = MzDB::conectar();       
            if (!$db) {
                return false;
            } else {
                $stmt= $db->prepare("SELECT * FROM productos WHERE id = :id LIMIT 1");
                $stmt->bindParam(":id", $id, PDO::PARAM_INT);
                $stmt->execute();
                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                return $resultado;
            }
        }
    }

?>