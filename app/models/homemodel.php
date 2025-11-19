<?php
    require_once("mzDb.php");
    class Homemodel extends MzDB {

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

        public static function  getVendidos(){
            $db = MzDB::conectar();       
            if (!$db) {
                return false;
            } else {
                $stmt= $db->prepare("SELECT 
                    p.id,
                    p.name,
                    p.image,
                    p.price,
                    SUM(c.cantidad) AS total_vendido
                FROM compras c
                INNER JOIN productos p ON p.id = c.id_producto
                WHERE c.estado = 'pendiente' OR c.estado = 'completado'
                GROUP BY p.id
                ORDER BY total_vendido DESC
                LIMIT 5;");
                $stmt->execute();
                $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $resultado;
            }
        }

        public static function  getrecomendados($id){
            $db = MzDB::conectar();       
            if (!$db) {
                return false;
            } else {
                $stmt= $db->prepare("SELECT p.id, p.name, p.category
                FROM compras c
                JOIN productos p ON p.id = c.id_producto
                WHERE c.id_comprador = :user
                ORDER BY c.creado_en DESC
                LIMIT 1");
                $stmt->bindParam(":user", $id, PDO::PARAM_INT);
                $stmt->execute();
                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);

                $stmt= $db->prepare("SELECT p2.id, p2.name,p2.category ,COUNT(*) AS frecuencia, p2.image, p2.price
                FROM compras c1
                JOIN compras c2 ON c1.id_comprador = c2.id_comprador
                JOIN productos p2 ON p2.id = c2.id_producto
                WHERE c1.id_producto = :produc
                AND c2.id_producto <> c1.id_producto
                GROUP BY p2.id
                ORDER BY frecuencia DESC
                LIMIT 5;");
                $stmt->bindParam(":produc", $resultado['id'], PDO::PARAM_INT);
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

        public static function buscar($texto) {
            $db = MzDB::conectar();
             if (!$db) {
                return false;
            } else {
                $q = "%" . strtolower($texto) . "%";
                $sql = "SELECT DISTINCT 
                            p.id,
                            p.name,
                            p.price,
                            p.image,
                            p.category
                        FROM productos p
                        LEFT JOIN productos_tags t ON t.id_producto = p.id
                        WHERE 
                            LOWER(p.name) LIKE :q
                            OR LOWER(t.tag) LIKE :q
                        ORDER BY p.name ASC
                        LIMIT 8";
                $stmt = $db->prepare($sql);
                $stmt->bindParam(":q", $q, PDO::PARAM_STR);
                $stmt->execute();
                return $stmt->fetchAll(PDO::FETCH_ASSOC);
            }
        }
    }

?>