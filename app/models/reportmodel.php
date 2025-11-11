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


}
?>
