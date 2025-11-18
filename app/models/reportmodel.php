<?php
require_once("mzDb.php");

class ReportModel extends MzDB {

    public static function reportSell($id) {
        $db = MzDB::conectar();
        if (!$db) {
            return "errordb";
        } else {
            $stmt = $db->prepare("SELECT c.cantidad,p.name as product, p.price, CONCAT(u.nombre,' ',u.apellidos) as comprador,(p.price*c.cantidad) as total 
            FROM compras c 
            JOIN productos p ON p.id = c.id_producto 
            JOIN usuarios u ON c.id_comprador=u.id 
            WHERE p.id_user = :user");
            $stmt->bindParam(":user", $id, PDO::PARAM_INT);
            $stmt->execute();
            $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
            return $resultado;
        }
    }

    public static function generalReport($id) {
        $db = MzDB::conectar();
        if (!$db) {
            return "errordb";
        } else {
            $sqlVentas = "
            SELECT 
                c.nombre AS categoria, 
                SUM(oi.cantidad * p.price) AS total_vendido
            FROM compras oi
            JOIN productos p ON oi.id_producto = p.id
            JOIN categorias c ON p.category = c.id
            WHERE p.id_user = :user
            GROUP BY p.category
            ";

            $stmtVentas = $db->prepare($sqlVentas);
            $stmtVentas->bindParam(":user", $id, PDO::PARAM_INT);
            $stmtVentas->execute();
            $ventas = $stmtVentas->fetchAll(PDO::FETCH_ASSOC);


            $sqlCompras = "
                SELECT 
                    c.nombre AS categoria, 
                    COUNT(*) AS total_compras
                FROM compras oi
                JOIN productos p ON oi.id_producto = p.id
                JOIN categorias c ON p.category = c.id
                WHERE p.id_user = :user
                GROUP BY p.category
            ";

            $stmtCompras = $db->prepare($sqlCompras);
            $stmtCompras->bindParam(":user", $id, PDO::PARAM_INT);
            $stmtCompras->execute();
            $compras = $stmtCompras->fetchAll(PDO::FETCH_ASSOC);


            // ----------------------
            // 3. Reporte general (ventas + compras)
            // ----------------------
            $sqlGeneral = "
                SELECT 
                    c.nombre AS categoria,
                    SUM(oi.cantidad * p.price) AS total_vendido,
                    COUNT(*) AS total_compras
                FROM compras oi
                JOIN productos p ON oi.id_producto = p.id
                JOIN categorias c ON p.category = c.id
                WHERE p.id_user = :user
                GROUP BY p.category
            ";

            $stmtGeneral = $db->prepare($sqlGeneral);
            $stmtGeneral->bindParam(":user", $id, PDO::PARAM_INT);
            $stmtGeneral->execute();
            $general = $stmtGeneral->fetchAll(PDO::FETCH_ASSOC);

            return [
                "success" => true,
                "ventas"  => $ventas,
                "compras" => $compras,
                "general" => $general
            ];
        }
    }

    public static function reportSolds($id) {
        $db = MzDB::conectar();
        if (!$db) {
            return "errordb";
        } else {
            $stmt = $db->prepare("SELECT 
            c.nombre AS categoria,
            p.name AS producto,
            SUM(oi.cantidad) AS vendidos,
            SUM(oi.cantidad * p.price) AS ingresos
            FROM compras oi
            JOIN productos p ON p.id = oi.id_producto
            JOIN categorias c ON c.id = p.category
            WHERE p.id_user = :user
            GROUP BY p.id
            ORDER BY c.nombre, vendidos DESC");
            $stmt->bindParam(":user", $id, PDO::PARAM_INT);
            $stmt->execute();
             $rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
            $categorias = [];

            foreach ($rows as $fila) {
                $categoria = $fila['categoria'];
                $categorias[$categoria][] = $fila;
            }
            return $categorias;
        }
    }


}
?>
