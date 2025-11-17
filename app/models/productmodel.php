<?php
    require_once("mzDb.php");
    class Productmodel extends MzDB {

        public static function  getOneProduct($id){
            $db = MzDB::conectar();       
            if (!$db) {
                return false;
            } else {
                $stmt= $db->prepare("SELECT p.*, u.nombre, u.apellidos, u.id FROM productos p JOIN usuarios u ON p.id_user = u.id WHERE p.id = :id LIMIT 1");
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

        public static function getProductsByCategory($categoryId, $user) {
            $db = MzDB::conectar();
            if (!$db) {
                return false;
            } else {
                $stmt = $db->prepare("SELECT p.*, c.nombre AS categoria 
                FROM productos p JOIN categorias c ON p.category = c.id 
                WHERE p.category = :categoryId");
                $stmt->bindParam(":categoryId", $categoryId, PDO::PARAM_INT);
                $stmt->execute();
                $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);

                if ($user === null) {
                    foreach ($resultado as $p) {
                        $p["precio_descuento"] = null;
                        $p["descuento_porcentaje"] = 0;
                    }
                    return $resultado;
                }

                $stmt = $db->prepare("
                    SELECT porcentaje
                    FROM descuentos
                    WHERE id_user = :uid AND usado = 0
                    ORDER BY id DESC
                    LIMIT 1;
                ");
                $stmt->execute(["uid" => $user]);
                $descuento = $stmt->fetch(PDO::FETCH_ASSOC);

                $porcentaje = $descuento ? intval($descuento["porcentaje"]) : 0;

                // 3. Agregar precio con descuento al producto
                foreach ($resultado as &$p) {
                    $original = floatval($p["price"]);

                    if ($porcentaje > 0) {
                        $p["precio_descuento"] = $original - ($original * ($porcentaje / 100));
                        $p["descuento_porcentaje"] = $porcentaje;
                    } else {
                        $p["precio_descuento"] = null;
                        $p["descuento_porcentaje"] = 0;
                    }
                }

                return $resultado;
                
            }
        }

        public static function getProductsByCategorycount($categoryId) {
            $db = MzDB::conectar();
            if (!$db) {
                return false;
            } else {
                $stmt = $db->prepare("SELECT COUNT(*) FROM productos WHERE category = :categoryId");
                $stmt->bindParam(":categoryId", $categoryId, PDO::PARAM_INT);
                $stmt->execute();
                $resultado = $stmt->fetchColumn();
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

                $stmt = $db->prepare("SELECT id, porcentaje FROM descuentos 
                          WHERE id_user = :usuario_id AND usado = 0 
                          ORDER BY id DESC LIMIT 1");
                $stmt->bindParam(':usuario_id', $data['usuario'], PDO::PARAM_INT);
                $stmt->execute();
                $descuento = $stmt->fetch(PDO::FETCH_ASSOC);
                $id_descuento = $descuento ? $descuento['id'] : null;

              if ($producto) {
                  if ($producto['stock'] >= $data['cantidad']) {
                      // Realizar la compra
                      $stmt = $db->prepare('INSERT INTO compras (id_producto, cantidad, id_comprador, descuento) VALUES (:producto_id, :cantidad, :usuario_id, :id_descuento)');
                      $stmt->bindParam(':producto_id', $data['id'], PDO::PARAM_INT);
                      $stmt->bindParam(':cantidad', $data['cantidad'], PDO::PARAM_INT);
                      $stmt->bindParam(':usuario_id', $data['usuario'], PDO::PARAM_INT);
                      $stmt->bindParam(':id_descuento', $id_descuento);
                      $stmt->execute();

                        // Actualizar el stock del producto
                      $stmt = $db->prepare('UPDATE productos SET stock = stock - :cantidad WHERE id = :producto_id');
                      $stmt->bindParam(':cantidad', $data['cantidad'], PDO::PARAM_INT);
                      $stmt->bindParam(':producto_id', $data['id'], PDO::PARAM_INT);
                      $stmt->execute();

                      if ($id_descuento) {
                            $stmt = $db->prepare("UPDATE descuentos SET usado = 1 WHERE id = :id");
                            $stmt->bindParam(':id', $id_descuento, PDO::PARAM_INT);
                            $stmt->execute();
                        }
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