<?php
    require_once("mzDb.php");
    class Adminmodel extends MzDB {

        public static function getAllVerificaciones() {
        $db = MzDB::conectar();
        if (!$db) {
            return [];
        }

        $stmt = $db->prepare("
            SELECT v.id, v.usuario_id, v.tipo_documento, v.numero_documento, v.estado, 
                   u.correo, u.cedula 
            FROM verificaciones v
            JOIN usuarios u ON v.usuario_id = u.id
            ORDER BY v.fecha_envio DESC
        ");

        $stmt->execute();
        return $stmt->fetchAll(PDO::FETCH_ASSOC);
    }

    public static function getVerificacionByUserId($usuarioId) {
        $db = MzDB::conectar();
        if (!$db) return null;

        $stmt = $db->prepare("
            SELECT v.*, u.correo, u.cedula
            FROM verificaciones v
            JOIN usuarios u ON v.usuario_id = u.id
            WHERE v.usuario_id = :usuario_id
            LIMIT 1
        ");
        $stmt->bindParam(':usuario_id', $usuarioId, PDO::PARAM_INT);
        $stmt->execute();

        return $stmt->fetch(PDO::FETCH_ASSOC);
        }       
    }

?>