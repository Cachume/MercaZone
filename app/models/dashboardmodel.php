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

        public static function getCategories(){
            $db = MzDB::conectar();       
            if (!$db) {
                return false;
            } else {
                $stmt= $db->prepare("SELECT * FROM categorias;");
                $stmt->execute();
                $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $resultado;
            }
        }

        public static function addProduct($data){
            $db = MzDB::conectar();  
            try{
                if (!$db) {
                    return ['success'=>false,'message'=>'Error de conexión a la base de datos'];
                } else {
                    $stmt= $db->prepare("INSERT INTO productos (id_user, name, category, price, stock, image , description, short_description) VALUES (:id_user, :name, :category, :price, :stock, :image, :description, :short_description);");
                    $stmt->bindParam(':name', $data['name'], PDO::PARAM_STR);
                    $stmt->bindParam(':description', $data['full_description'], PDO::PARAM_STR);
                    $stmt->bindParam(':price', $data['price'], PDO::PARAM_STR);
                    $stmt->bindParam(':stock', $data['stock'], PDO::PARAM_INT);
                    $stmt->bindParam(':category', $data['category'], PDO::PARAM_STR);
                    $stmt->bindParam(':id_user', $data['userId'], PDO::PARAM_INT);
                    $stmt->bindParam(':image', $data['image'], PDO::PARAM_STR);
                    $stmt->bindParam(':short_description', $data['description'], PDO::PARAM_STR);
                }
                if($stmt->execute()){
                    return ['success'=>true,'message'=>'Producto agregado correctamente'];
                }else{
                    return ['success'=>false,'message'=>'Error al agregar el producto'];
                }
            } catch (Exception $e) {
                return ['success'=>false,'message'=>'Excepción: '.$e->getMessage()];
            }
        }
    }

?>