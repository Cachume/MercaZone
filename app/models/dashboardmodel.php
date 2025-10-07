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

        public static function getMyProducts($userId){
            $db = MzDB::conectar();       
            if (!$db) {
                return false;
            } else {
                $stmt= $db->prepare("SELECT * FROM productos WHERE id_user=:userId;");
                $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
                $stmt->execute();
                $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $resultado;
            }
        }

        public static function getMyProduct($id_product){
            $db = MzDB::conectar();       
            if (!$db) {
                return false;
            } else {
                $stmt= $db->prepare("SELECT * FROM productos WHERE id=:id_product;");
                $stmt->bindParam(':id_product', $id_product, PDO::PARAM_INT);
                $stmt->execute();
                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                return $resultado;
            }
        }

        public static function getMyOrders($userId){
            $db = MzDB::conectar();       
            if (!$db) {
                return false;
            } else {
                $stmt= $db->prepare("SELECT p.name AS product_name,p.price ,c.cantidad AS amount, u.nombre AS buyer_name, u.apellidos AS buyer_lastname, u.foto_perfil AS buyer_image, u.correo AS buyer_email FROM productos p JOIN compras c ON c.id_producto=p.id JOIN usuarios u ON u.id=c.id_comprador WHERE p.id_user = :userId;");
                $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
                $stmt->execute();
                $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $resultado;
            }
        }
    }

?>