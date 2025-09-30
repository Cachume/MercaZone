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

         // Actualizar intentos fallidos
        public static function actualizarIntentos($correo, $intentos) {
            $db = self::conectar();
            if (!$db) return false;

            $stmt = $db->prepare("UPDATE usuarios SET intentos_fallidos = :intentos WHERE correo = :correo");
            $stmt->bindParam(":intentos", $intentos, PDO::PARAM_INT);
            $stmt->bindParam(":correo", $correo, PDO::PARAM_STR);

            return $stmt->execute();
        }

        // Bloquear cuenta
        public static function bloquearCuenta($correo) {
            $db = self::conectar();
            if (!$db) return false;

            $stmt = $db->prepare("UPDATE usuarios SET cuenta_bloqueada = 1, tiempo_bloqueo = NOW() WHERE correo = :correo");
            $stmt->bindParam(":correo", $correo, PDO::PARAM_STR);

            return $stmt->execute();
        }

        // Desbloquear cuenta
        public static function desbloquearCuenta($correo) {
            $db = self::conectar();
            if (!$db) return false;

            $stmt = $db->prepare("UPDATE usuarios SET cuenta_bloqueada = 0, intentos_fallidos = 0, tiempo_bloqueo = NULL WHERE correo = :correo");
            $stmt->bindParam(":correo", $correo, PDO::PARAM_STR);

            return $stmt->execute();
        }

        public static function buscarPorCedula($cedula) {
            $db = MzDB::conectar();
            if (!$db) return false;

            $stmt = $db->prepare("SELECT * FROM usuarios WHERE cedula = :cedula");
            $stmt->bindParam(":cedula", $cedula, PDO::PARAM_STR);
            $stmt->execute();

            return $stmt->fetch(PDO::FETCH_ASSOC);
        }

    }

?>