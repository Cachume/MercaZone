<?php
require_once("models/verificacionmodel.php");
class VerificacionController {

    public $mensajes;

    public function __CONSTRUCT() {
        $this->mensajes = [];
        if(!isset($_SESSION['id_user'])) {
            $this->mensajes[] = "Usuario no autenticado.";
            header("Location: index.php?u=auth");
            exit();
        } else {
            // Verificar el estado de la verificación del usuario
            $usuario_id = $_SESSION['id_user'];
            $estado_verificacion = VerificacionModel::GetVerificacion(["usuario_id" => $usuario_id]);
            if ($estado_verificacion == "pendiente" || $estado_verificacion == "aceptado") {
                header("Location: index.php?u=perfil");
                exit();
            }
        }
    }

    // Mostrar la vista del formulario
    public function default() {
        require('views/user/verificacion.php');
    }

    // Procesar envío del formulario
    public function enviar() {
        echo 'entro';
        if ($_SERVER['REQUEST_METHOD'] !== 'POST') {
            $this->mensajes[] = "Método no permitido.";
            echo 'método no permitido';
            return;
        }

        $usuario_id = $_SESSION['id_user'] ?? null;
        if (!$usuario_id) {
            $this->mensajes[] = "Usuario no autenticado.";
            echo 'no autenticado';
            return;
        }

        var_dump($this->mensajes);
        $tipo_documento = $_POST['document-type'];
        $numero_documento = htmlspecialchars($_POST['document-number']);

        $upload_dir = 'assets/verificaciones/';
        if (!file_exists($upload_dir)) {
            mkdir($upload_dir, 0777, true);
            echo'se creo';
        }

        // Guardar archivos
        $cedula_frontal = null;
        $cedula_reverso = null;
        $pasaporte_imagen = null;
        $selfie_imagen = $this->guardarArchivo('selfie-file', $upload_dir);

        if ($tipo_documento === 'cedula') {
            $cedula_frontal = $this->guardarArchivo('cedula-front', $upload_dir);
            $cedula_reverso = $this->guardarArchivo('cedula-back', $upload_dir);
        } elseif ($tipo_documento === 'pasaporte') {
            $pasaporte_imagen = $this->guardarArchivo('passport-file', $upload_dir);
        }

        // Validaciones
        if (!$selfie_imagen || 
            ($tipo_documento === 'cedula' && (!$cedula_frontal || !$cedula_reverso)) || 
            ($tipo_documento === 'pasaporte' && !$pasaporte_imagen)) {
            $this->mensajes[] = "Archivos faltantes o inválidos.";
            return;
        }

        $resultado = VerificacionModel::registrarVerificacion([
        "usuario_id" => $usuario_id,
        "tipo_documento" => $tipo_documento,
        "numero_documento" => $numero_documento,
        "cedula_frontal" => $cedula_frontal,
        "cedula_reverso" => $cedula_reverso,
        "pasaporte_imagen" => $pasaporte_imagen,
        "selfie_imagen" => $selfie_imagen,
        "estado" => "pendiente"
        ]);

        if ($resultado) {
            header("Location: index.php?u=verificacion&r=success");
        } else {
            header("Location: index.php?u=verificacion&r=error");
        }
    }

    // 🔒 Función privada para manejar archivos
    private function guardarArchivo($campo, $upload_dir) {
        if (isset($_FILES[$campo]) && $_FILES[$campo]['error'] === UPLOAD_ERR_OK) {
            $tmp = $_FILES[$campo]['tmp_name'];
            $nombre_archivo = uniqid() . '_' . basename($_FILES[$campo]['name']);
            $ruta = $upload_dir . $nombre_archivo;
            move_uploaded_file($tmp, $ruta);
            return $ruta;
        }
        return null;
    }
}
