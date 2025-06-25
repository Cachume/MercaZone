<?php
    require_once("mzDb.php");
    class Authmodel extends MzDB {

        public static function registerUser($data){
            $db = MzDB::conectar();       
            if (!$db) {
                return "errordb";
            } else {
                $stmt= $db->prepare("INSERT INTO usuarios (cedula, correo, contrasena, rol) VALUES (:cedula,:correo,:contrasena,:rol)");
                $stmt->bindParam(":cedula", $data["cedula"], PDO::PARAM_INT);
                $stmt->bindParam(":correo", $data["correo"], PDO::PARAM_STR);
                $stmt->bindParam(":contrasena", $data["contrasena"], PDO::PARAM_STR);
                $stmt->bindParam(":rol", $data["rol"], PDO::PARAM_STR);
                if ($stmt->execute()) {
                    return true;
                }else{
                    return false;
                }
            }
        }

        public static function cedulaExiste($cedula) {
            $db = MzDB::conectar();
            if (!$db) return false;

            $stmt = $db->prepare("SELECT COUNT(*) FROM usuarios WHERE cedula = :cedula");
            $stmt->bindParam(":cedula", $cedula, PDO::PARAM_INT);
            $stmt->execute();
            return $stmt->fetchColumn() > 0;
        }

        public static function correoExiste($correo) {
            $db = MzDB::conectar();
            if (!$db) return false;
            $stmt = $db->prepare("SELECT COUNT(*) FROM usuarios WHERE correo = :correo");
            $stmt->bindParam(":correo", $correo, PDO::PARAM_STR);
            $stmt->execute();
            return $stmt->fetchColumn() > 0;
        }

        public static function loginUser($correo, $contrasena) {
            $db = MzDB::conectar();
            if (!$db) return false;

            $stmt = $db->prepare("SELECT * FROM usuarios WHERE correo = :correo");
            $stmt->bindParam(":correo", $correo, PDO::PARAM_STR);
            $stmt->execute();

            $usuario = $stmt->fetch(PDO::FETCH_ASSOC);
            return $usuario; 
        }

    }

?>