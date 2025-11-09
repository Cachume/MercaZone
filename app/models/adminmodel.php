<?php
    require_once("mzDb.php");
    class Adminmodel extends MzDB {

        public static function getAllVerificaciones() {
        $db = MzDB::conectar();
        if (!$db) {
            return [];
        }

        $stmt = $db->prepare("
            SELECT v.id, v.usuario_id, u.type_dni, v.estado, 
                   u.correo, u.cedula 
            FROM verificaciones v
            JOIN usuarios u ON v.usuario_id = u.id
            ORDER BY v.fecha_envio DESC
        ");

        $stmt->execute();
        $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
        return $resultado;
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
    
    public static function getUsers(){
            $db = MzDB::conectar();       
            if (!$db) {
                return false;
            } else {
                $stmt= $db->prepare("SELECT u.nombre,u.apellidos,u.correo,u.cedula,u.rol,r.rol_name FROM usuarios u JOIN rol r ON u.rol = r.id");
                $stmt->execute();
                $resultado = $stmt->fetchAll(PDO::FETCH_ASSOC);
                return $resultado;
            }
        }    
        

    }

?>