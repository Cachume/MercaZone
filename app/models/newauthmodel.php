<?php
    require_once("mzDb.php");
    class NewAuthmodel extends MzDB {
    
    public static function NewUser($data){
        $db = MzDB::conectar();
        if (!$db) return false;

        $stmt = $db->prepare(("INSERT INTO `usuarios`( `nombre`, `apellidos`, `type_dni`, `cedula`, `cumpleanos`, `correo`,`active`, `token`, `rol`) VALUES
        (:nombre, :apellidos, :type_dni, :cedula, :cumpleanos, :correo,:active, :token, :rol)
        "));
        $stmt->bindParam(":nombre", $data["name"], PDO::PARAM_STR);
        $stmt->bindParam(":apellidos", $data["lastname"], PDO::PARAM_STR);
        $stmt->bindParam(":type_dni", $data["type_dni"], PDO::PARAM_STR);
        $stmt->bindParam(":cedula", $data["dni"], PDO::PARAM_INT);
        $stmt->bindParam(":cumpleanos", $data["birthday"], PDO::PARAM_STR);
        $stmt->bindParam(":correo", $data["email"], PDO::PARAM_STR);
        $stmt->bindParam(":active", $data["active"], PDO::PARAM_INT);
        $stmt->bindParam(":token", $data["token"], PDO::PARAM_STR);
        $stmt->bindParam(":rol", $data["rol"], PDO::PARAM_INT);
        $exec = $stmt->execute();
        if(!$exec){
            return false;
        }
        
        return true;
    }

    public static function confirmAccount($token,$hash){
        $db = MzDB::conectar();
        if (!$db) return false;
        $stmt = $db->prepare("SELECT id, correo FROM usuarios WHERE token= :token AND active= 0 LIMIT 1");
        $stmt->bindParam(":token", $token, PDO::PARAM_STR);
        $stmt->execute();
        $user = $stmt->fetch(PDO::FETCH_ASSOC);
        if(!$user){
            return false;
        }
        $stmtUpdate = $db->prepare("UPDATE usuarios 
                                    SET contrasena = :contrasena, active = 1, token= NULL  
                                    WHERE id = :id");
        $stmtUpdate->bindParam(":contrasena", $hash, PDO::PARAM_STR);
        $stmtUpdate->bindParam(":id", $user['id'], PDO::PARAM_INT);
        if($stmtUpdate->execute()){
            return [true, $user['correo']];
        }

        return false;
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