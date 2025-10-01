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

        public static function  getCategorys(){
            $db = MzDB::conectar();       
            if (!$db) {
                return false;
            } else {
                $stmt= $db->prepare("SELECT * FROM categorias");
                $stmt->execute();
                $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $resultado;
            }
        }

        public static function getProductsByCategory($categoryId) {
            $db = MzDB::conectar();
            if (!$db) {
                return false;
            } else {
                $stmt = $db->prepare("SELECT p.*, c.nombre AS categoria FROM productos p JOIN categorias c ON p.category = c.id WHERE p.category = :categoryId");
                $stmt->bindParam(":categoryId", $categoryId, PDO::PARAM_INT);
                $stmt->execute();
                $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $resultado;
            }
        }

        public static function buyProduct($data){
            $db = MzDB::conectar();       
            if (!$db) {
                return ['success'=>false,'message'=>'Error de conexion a la base de datos'];
            } else {
              $stmt = $db->prepare('SELECT id, stock FROM productos WHERE id = :producto_id LIMIT 1');
              $stmt->bindParam(':producto_id', $data['id'], PDO::PARAM_INT);
              $stmt->execute();
              $producto = $stmt->fetch(PDO::FETCH_ASSOC);
              if ($producto) {
                  if ($producto['stock'] >= $data['cantidad']) {
                      // Realizar la compra
                      $stmt = $db->prepare('INSERT INTO compras (id_producto, cantidad, id_comprador) VALUES (:producto_id, :cantidad, :usuario_id)');
                      $stmt->bindParam(':producto_id', $data['id'], PDO::PARAM_INT);
                      $stmt->bindParam(':cantidad', $data['cantidad'], PDO::PARAM_INT);
                      $stmt->bindParam(':usuario_id', $data['usuario'], PDO::PARAM_INT);
                      $stmt->execute();

                        // Actualizar el stock del producto
                      $stmt = $db->prepare('UPDATE productos SET stock = stock - :cantidad WHERE id = :producto_id');
                      $stmt->bindParam(':cantidad', $data['cantidad'], PDO::PARAM_INT);
                      $stmt->bindParam(':producto_id', $data['id'], PDO::PARAM_INT);
                      $stmt->execute();
                      return ['success'=>true,'message'=>'Compra realizada con éxito'];
                  } else {
                      return ['success'=>false,'message'=>'Stock insuficiente'];
                  }
              } else {
                  return ['success'=>false,'message'=>'Producto no encontrado'];
              }
            }
        }
    }

?>