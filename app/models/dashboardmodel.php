<?php
    require_once("mzDb.php");
    class Dashboardmodel extends MzDB {


        public static function  getMyPurchases($userId){
            $db = MzDB::conectar();       
            if (!$db) {
                return false;
            } else {
                $stmt= $db->prepare("SELECT c.*, p.* FROM compras c JOIN productos p ON p.id = c.id_producto WHERE id_comprador=:userId;");
                $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
                $stmt->execute();
                $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $resultado;
            }
        }
    }

?>