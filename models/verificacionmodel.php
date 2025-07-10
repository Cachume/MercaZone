<?php
require_once("mzDb.php");

class VerificacionModel extends MzDB {

    public static function registrarVerificacion($data) {
        $db = MzDB::conectar();
        if (!$db) {
            return "errordb";
        } else {
            $stmt = $db->prepare("INSERT INTO verificaciones (
                usuario_id, tipo_documento, numero_documento, cedula_frontal, cedula_reverso,
                pasaporte_imagen, selfie_imagen, estado
            ) VALUES (
                :usuario_id, :tipo_documento, :numero_documento, :cedula_frontal, :cedula_reverso,
                :pasaporte_imagen, :selfie_imagen, :estado
            )");

            $stmt->bindParam(":usuario_id", $data["usuario_id"], PDO::PARAM_INT);
            $stmt->bindParam(":tipo_documento", $data["tipo_documento"], PDO::PARAM_STR);
            $stmt->bindParam(":numero_documento", $data["numero_documento"], PDO::PARAM_STR);
            $stmt->bindParam(":cedula_frontal", $data["cedula_frontal"], PDO::PARAM_STR);
            $stmt->bindParam(":cedula_reverso", $data["cedula_reverso"], PDO::PARAM_STR);
            $stmt->bindParam(":pasaporte_imagen", $data["pasaporte_imagen"], PDO::PARAM_STR);
            $stmt->bindParam(":selfie_imagen", $data["selfie_imagen"], PDO::PARAM_STR);
            $stmt->bindParam(":estado", $data["estado"], PDO::PARAM_STR);

            if ($stmt->execute()) {
                return true;
            } else {
                return false;
            }
        }
    }
}
?>
