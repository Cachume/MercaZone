<?php
    require_once("mzDb.php");
    class Dashboardmodel extends MzDB {



        public static function getDashData($userId){
            $db = MzDB::conectar();       
            if (!$db) {
                return false;
            } else {
                $stmt = $db->prepare("
                    SELECT COUNT(*) AS total
                    FROM compras
                    WHERE MONTH(creado_en) = MONTH(CURRENT_DATE()) AND id_comprador= :userId;
                ");
                $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
                $stmt->execute();
                $compras_mes = $stmt->fetch(PDO::FETCH_ASSOC)["total"];

                $stmt = $db->prepare("
                    SELECT COUNT(*) AS total 
                    FROM compras c 
                    JOIN productos p on p.id = c.id_producto 
                    WHERE MONTH(creado_en) = MONTH(CURRENT_DATE()) AND p.id_user= :userId;");
                $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
                $stmt->execute();
                $ventas_mes = $stmt->fetch(PDO::FETCH_ASSOC)["total"];

                $stmt = $db->prepare("
                    SELECT SUM(p.price * c.cantidad) AS total
                    FROM compras c
                    JOIN productos p ON p.id = c.id_producto
                    WHERE MONTH(c.creado_en) = MONTH(CURRENT_DATE())
                    AND id_user = :userId
                ");
                $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
                $stmt->execute();
                $dinero_ganado = $stmt->fetch(PDO::FETCH_ASSOC)["total"] ?? 0;

                $stmt = $db->prepare("
                    SELECT 
                        p.name AS producto,
                        CONCAT(u.nombre, ' ', u.apellidos) AS comprador
                    FROM compras c
                    JOIN productos p ON p.id = c.id_producto
                    JOIN usuarios u ON u.id = c.id_comprador
                    WHERE id_user = :userId
                    ORDER BY c.creado_en DESC
                    LIMIT 5;
                ");
                $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
                $stmt->execute();
                $ventas_recientes = $stmt->fetchAll(PDO::FETCH_ASSOC);

                $stmt = $db->prepare("
                    SELECT 
                        CONCAT(u.nombre, ' ', u.apellidos) AS name,
                        u.correo AS email,
                        u.id,
                        COUNT(*) AS cantidad
                    FROM compras c
                    JOIN usuarios u ON u.id = c.id_comprador
                    JOIN productos p ON p.id = c.id_producto
                    WHERE p.id_user = :userId
                    GROUP BY c.id_comprador
                    ORDER BY cantidad DESC
                    LIMIT 5;
                ");
                $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
                $stmt->execute();
                $top_compradores = $stmt->fetchAll(PDO::FETCH_ASSOC);

                return [
                    "compras_mes"      => $compras_mes,
                    "ventas_mes"       => $ventas_mes,
                    "dinero_ganado"    => $dinero_ganado,
                    "ventas_recientes" => $ventas_recientes,
                    "top_compradores"  => $top_compradores
                    ];
            }
        }

        public static function setDiscount($data){
            $db = MzDB::conectar();   
            $stmt = $db->prepare("
                INSERT INTO descuentos (id_user, id_adm, porcentaje,comentario)
            VALUES (:user, :admin, :discount, :note)
            ");
            $stmt->bindParam(':user', $data['user'], PDO::PARAM_INT);
            $stmt->bindParam(':admin', $data['admin'], PDO::PARAM_INT);
            $stmt->bindParam(':discount', $data['discount'], PDO::PARAM_INT);
            $stmt->bindParam(':note', $data['note'], PDO::PARAM_INT);
            $stmt->execute();
            if($stmt){
                return true;
            }else{
                return false;
            }
        }
        public static function  getMyPurchases($userId){
            $db = MzDB::conectar();       
            if (!$db) {
                return false;
            } else {
                $stmt= $db->prepare("SELECT c.id AS compraid,c.cantidad,c.estado,c.creado_en ,p.*,d.porcentaje 
                FROM compras c 
                JOIN productos p ON p.id = c.id_producto 
                LEFT JOIN descuentos d ON d.id=c.descuento
                WHERE id_comprador=:userId;");
                $stmt->bindParam(':userId', $userId, PDO::PARAM_INT);
                $stmt->execute();
                $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $resultado;
            }
        }

        public static function getSolds($userId){
            $db = MzDB::conectar();       
            if (!$db) {
                return false;
            } else {
                $stmt= $db->prepare("
                SELECT p.name, SUM(oi.cantidad) AS total_vendidos
                FROM compras oi
                JOIN productos p ON p.id = oi.id_producto
                WHERE p.id_user = :userId
                GROUP BY oi.id_producto
                ORDER BY total_vendidos DESC
                LIMIT 5;");
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
                $stmt= $db->prepare("SELECT c.id, p.name AS product_name,p.price ,c.cantidad AS amount, u.nombre AS buyer_name, u.apellidos AS buyer_lastname, u.foto_perfil AS buyer_image, u.correo AS buyer_email FROM productos p JOIN compras c ON c.id_producto=p.id JOIN usuarios u ON u.id=c.id_comprador WHERE p.id_user = :userId;");
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
        
        public static function getAllMensages($id){
            $db = MzDB::conectar();   
            $stmt = $db->prepare("
               SELECT
                chat_mensajes.id,
                chat_mensajes.id_usuario,
                usuarios.nombre AS sender_name,
                usuarios.apellidos AS sender_lastname,
                usuarios.foto_perfil AS sender_photo,
                chat_mensajes.mensaje,
                DATE_FORMAT(chat_mensajes.creado_en, '%h:%i %p') AS time
            FROM chat_mensajes
            INNER JOIN usuarios ON usuarios.id = chat_mensajes.id_usuario
            WHERE chat_mensajes.id_chat = :compra
            ORDER BY chat_mensajes.creado_en ASC;
            ");
            $stmt->bindParam(':compra', $id, PDO::PARAM_INT);
            $stmt->execute();
            $messages = $stmt->fetchAll(PDO::FETCH_ASSOC);
            if($messages){
                return $messages;
            }else{
                return false;
            }
        }

        public static function SendMensages($compra,$usuario,$mensaje){
            $db = MzDB::conectar();   
            $stmt = $db->prepare("
                INSERT INTO chat_mensajes (id_chat, id_usuario, mensaje, creado_en)
            VALUES (:compra, :usuario, :mensaje, NOW())
            ");
            $stmt->bindParam(':compra', $compra, PDO::PARAM_INT);
            $stmt->bindParam(':usuario', $usuario, PDO::PARAM_INT);
            $stmt->bindParam(':mensaje', $mensaje, PDO::PARAM_STR);
            $stmt->execute();
            if($stmt){
                return true;
            }else{
                return false;
            }
        }
        public static function getstadisticUser($id){
            $db = MzDB::conectar();
            if (!$db) return false;
        } 
        
        public static function getUserVef($id_user){
            $db = MzDB::conectar();       
            if (!$db) {
                return false;
            } else {
                $stmt= $db->prepare("SELECT id,usuario_id,estado FROM verificaciones WHERE usuario_id=:id_user;");
                $stmt->bindParam(':id_user', $id_user, PDO::PARAM_INT);
                $stmt->execute();
                $resultado = $stmt->fetch(PDO::FETCH_ASSOC);
                return $resultado;
            }
        }

        public static function NewVerification($data){
            $db = MzDB::conectar();       
            if (!$db) {
                return false;
            } else {
                $stmt= $db->prepare("INSERT INTO verificaciones (usuario_id, cedula_frontal) VALUES (:user, :cedula)");
                $stmt->bindParam(':user', $data['user'], PDO::PARAM_INT);
                $stmt->bindParam(':cedula', $data['image'], PDO::PARAM_STR);
                $stmt->execute();
                if($stmt){
                    return true;
                }else{
                    return false;
                }
            }
        }
    }
?>