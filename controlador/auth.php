<?php
    require_once("models/authmodel.php");

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\Exception;

    require 'vendor/autoload.php';
    class AuthController{

        private $errores = [];
        private $mensajesc;

        public function default(){
            $mensaje = $this->mensajesc;
            if(isset($_SESSION['id_user'])){
                header('Location:/MercaZone');
                return;
            }
            require_once("views/auth.php");
        }
        public function login() {
    if (isset($_POST["iniciarsesion"])) {
        $correo = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
        $codigo = trim($_POST['password'] ?? '');

        $this->validarlogin($correo, $codigo);

        if (count($this->errores) > 0) {
            $errores = $this->errores;
            require_once("views/auth.php");
            return;
        }

        // Verificar código OTP en sesión
        if (
            !isset($_SESSION['otp_email'], $_SESSION['otp_code'], $_SESSION['otp_expires']) ||
            $_SESSION['otp_email'] !== $correo ||
            $_SESSION['otp_code'] !== $codigo ||
            time() > $_SESSION['otp_expires']
        ) {
            $this->errores[] = "Código incorrecto o expirado.";
            $errores = $this->errores;
            require_once("views/auth.php");
            return;
        }

        // Buscar usuario por correo
        $auth = AuthModel::loginUser($correo, ''); // 'contrasena' es irrelevante aquí
        if (!$auth) {
            $this->errores[] = "Correo no registrado.";
            $errores = $this->errores;
            require_once("views/auth.php");
            return;
        }

        // Verificar si cuenta está bloqueada
        if ($auth['cuenta_bloqueada']) {
            $now = new DateTime();
            $bloqueo = new DateTime($auth['tiempo_bloqueo']);
            $intervalo = $bloqueo->diff($now)->i;

            if ($intervalo < 1) {
                $this->errores[] = "Cuenta bloqueada por 1 minuto. Intente más tarde.";
                $errores = $this->errores;
                require_once("views/auth.php");
                return;
            } else {
                AuthModel::desbloquearCuenta($correo);
                $auth['cuenta_bloqueada'] = 0;
                $auth['intentos_fallidos'] = 0;
            }
        }

        // Login correcto, reiniciar intentos y guardar sesión
        AuthModel::actualizarIntentos($correo, 0);
        $_SESSION['id_user'] = $auth['id'];
        $_SESSION['nombre'] = $auth['nombre'];
        $_SESSION['apellidos'] = $auth['apellidos'];
        $_SESSION['correo'] = $auth['correo'];
        $_SESSION['cedula'] = $auth['cedula'];
        $_SESSION['rol'] = $auth['rol'];

        // Limpiar código OTP de sesión
        unset($_SESSION['otp_email'], $_SESSION['otp_code'], $_SESSION['otp_expires']);

        header('Location:/MercaZone');
        return;
    }

    print_r($_POST);
}

    public function register() {
        if (isset($_POST["registro"])) {

            $datos = array(
                "cedula" => filter_input(INPUT_POST, 'cedula', FILTER_VALIDATE_INT),
                "correo" => filter_input(INPUT_POST, 'emailr', FILTER_VALIDATE_EMAIL),
                "codigo" => $_POST['passwordr'], // ya no es contraseña
                "rol" => 'comprador'
            );

            // Validar campos básicos
            if (empty($datos['cedula']) || empty($datos['correo']) || empty($datos['codigo'])) {
                $this->errores[] = "Todos los campos son requeridos.";
            }

            if (!filter_var($datos['correo'], FILTER_VALIDATE_EMAIL)) {
                $this->errores[] = "Correo no válido.";
            }

            if (!is_numeric($datos['codigo']) || strlen($datos['codigo']) !== 6) {
                $this->errores[] = "El código debe tener exactamente 6 dígitos.";
            }

            // Validación del código OTP
            if (!isset($_SESSION['otp_code'], $_SESSION['otp_email'], $_SESSION['otp_expires'])) {
                $this->errores[] = "Código de verificación no encontrado. Por favor, solicita uno nuevamente.";
            } elseif ($_SESSION['otp_email'] !== $datos['correo']) {
                $this->errores[] = "El código de verificación no corresponde al correo ingresado.";
            } elseif (time() > $_SESSION['otp_expires']) {
                $this->errores[] = "El código de verificación ha expirado. Solicita uno nuevo.";
            } elseif ($_SESSION['otp_code'] !== $datos['codigo']) {
                $this->errores[] = "El código ingresado es incorrecto.";
            }

            // Verificar existencia en BD
            if (Authmodel::cedulaExiste($datos['cedula']) || Authmodel::correoExiste($datos['correo'])) {
                $this->errores[] = "Este correo o cédula ya está registrada.";
            }

            // Si hay errores, recarga vista
            if (!empty($this->errores)) {
                $errores = $this->errores;
                require_once("views/auth.php");
                return;
            }

            // Generar contraseña aleatoria interna (no usada directamente)
            $datos['contrasena'] = password_hash(bin2hex(random_bytes(6)), PASSWORD_DEFAULT);

            // Registrar usuario
            if (Authmodel::registerUser($datos)) {
                // limpiar OTP
                unset($_SESSION['otp_code'], $_SESSION['otp_email'], $_SESSION['otp_expires'], $_SESSION['otp_last_sent']);

                $this->mensajesc = ["success", "Usuario registrado correctamente"];
                $this->default();
            } else {
                $this->errores[] = "No se pudo completar el registro.";
                $errores = $this->errores;
                require_once("views/auth.php");
            }
        } else {
            header("Location:index.php?u=auth");
        }
    }


    public function sendCode() {
        header('Content-Type: application/json');
        if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
            $email = trim($_POST['email']);

            if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
                echo json_encode(['success' => false, 'message' => 'Correo no válido.']);
                return;
            }

             $usuario = AuthModel::loginUser($email, '');
            if (!$usuario) {
                echo json_encode(['success' => false, 'message' => 'Este correo no está registrado.']);
                return;
            }

            // Verificar tiempo de espera para reenviar
            if (isset($_SESSION['otp_last_sent']) && time() - $_SESSION['otp_last_sent'] < 30) {
                echo json_encode([
                    'success' => false,
                    'message' => 'Espera 30 segundos antes de solicitar otro código.'
                ]);
                return;
            }

            $codigo = rand(100000, 999999);

            $_SESSION['otp_email'] = $email;
            $_SESSION['otp_code'] = (string)$codigo;
            $_SESSION['otp_expires'] = time() + 60; // 5 minutos
            $_SESSION['otp_last_sent'] = time();

            if ($this->sendMail($email, $codigo)) {
                echo json_encode(['success' => true]);
            } else {
                echo json_encode(['success' => false, 'message' => 'No se pudo enviar el correo.']);
            }
                return;
            }

        echo json_encode(['success' => false, 'message' => 'Petición inválida.']);
    }

    private function sendMail($email_destino, $codigo){
        $mail = new PHPMailer(true);
        try {

            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';
            $mail->SMTPAuth = true;
            $mail->Username = 'albertq703@gmail.com'; // tu correo
            $mail->Password = 'njkrzphziuxwvetk';     // tu clave de app
            $mail->SMTPSecure = 'tls';
            $mail->Port = 587;

            $mail->setFrom('albertq703@gmail.com', 'Sistema OTP');
            $mail->addAddress($email_destino);

            $mail->isHTML(true);
            $mail->Subject = "Se ha generado un código de verificación";
            $mail->Body = "
                <div style='text-align: center; font-family: Arial, sans-serif; border: 1px solid #ccc; padding: 50px 80px; width: 300px; margin: auto; border-radius: 10px; background-color: #f9f9f9;'>
                    <h1>
                        <span style='color:#00b45d;'>Merca<span style='color:#014651;'>Zone</span></span>
                    </h1>
                    <span style='text-decoration:none;'>$email_destino</span>
                    <p>Se ha generado el siguiente código para iniciar sesión:</p>
                    <strong style='font-size: 30px;'>$codigo</strong>
                    <p>Si no has solicitado este código, por favor ignora este mensaje.</p>
                    <p>Gracias por usar MercaZone.</p>
                </div>";

            $mail->send();
            return true;

        } catch (Exception $e) {
            error_log("Error al enviar correo: " . $mail->ErrorInfo);
            return false;
        }
    }

public function sendCoder() {
    header('Content-Type: application/json');

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['email'])) {
        $email = trim($_POST['email']);
        $cedula = isset($_POST['cedula']) ? trim($_POST['cedula']) : null;

        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            echo json_encode(['success' => false, 'message' => 'Correo electrónico no válido.']);
            return;
        }

        require_once("models/authmodel.php");

        // Validar si el correo existe
        $usuarioCorreo = AuthModel::loginUser($email, '');
        if ($usuarioCorreo) {
            echo json_encode(['success' => false, 'message' => 'Este correo ya está registrado.']);
            return;
        }

        // Validar si la cédula existe (si viene en la petición)
        if ($cedula) {
            $usuarioCedula = AuthModel::buscarPorCedula($cedula); // crear esta función en el modelo
            if ($usuarioCedula) {
                echo json_encode(['success' => false, 'message' => 'Esta cédula ya está registrada.']);
                return;
            }
        }

        // Protección para evitar spam (30 segundos entre códigos)
        if (session_status() === PHP_SESSION_NONE) session_start();

        if (isset($_SESSION['otp_last_sent']) && time() - $_SESSION['otp_last_sent'] < 30) {
            echo json_encode([
                'success' => false,
                'message' => 'Espera 30 segundos antes de solicitar otro código.'
            ]);
            return;
        }

        // Generar y guardar código
        $codigo = rand(100000, 999999);
        $_SESSION['otp_email'] = $email;
        $_SESSION['otp_code'] = (string)$codigo;
        $_SESSION['otp_expires'] = time() + 300; // 5 minutos
        $_SESSION['otp_last_sent'] = time();

        // Enviar código por correo
        if ($this->sendMail($email, $codigo)) {
            echo json_encode(['success' => true]);
        } else {
            echo json_encode(['success' => false, 'message' => 'No se pudo enviar el correo.']);
        }

        return;
    }

    echo json_encode(['success' => false, 'message' => 'Petición inválida.']);
}
    private function validarRegistro($datos) {
        if (!preg_match('/^[0-9]{7,10}$/', $datos['cedula'])) {
            $this->errores[] = "La cédula debe tener entre 7 y 10 dígitos.";
        }

        if (!filter_var($datos['correo'], FILTER_VALIDATE_EMAIL)) {
            $this->errores[] = "Correo electrónico no válido.";
        }

        if (strlen($datos['contrasena']) < 6) {
            $this->errores[] = "La contraseña debe tener al menos 6 caracteres.";
        }

        if ($datos['contrasena'] !== $datos['contrasenac']) {
            $this->errores[] = "Las contraseñas no coinciden.";
        }

        if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[.$%#])[A-Za-z\d.$%#]+$/', $datos['contrasena'])) {
            $this->errores[] = "La contraseña debe contener al menos una letra, un número y uno de los símbolos: . $ % #";
        }

    }
    private function validarlogin($correo, $codigo) {
        if (empty($correo) || empty($codigo)) {
            $this->errores[] = "Todos los campos son requeridos.";
            return;
        }

        if (strlen($correo) > 60) {
            $this->errores[] = "El campo correo tiene un máximo de 60 caracteres.";
        }

        if (!filter_var($correo, FILTER_VALIDATE_EMAIL)) {
            $this->errores[] = "Correo electrónico no válido.";
        }

        if (!preg_match('/^\d{6}$/', $codigo)) {
            $this->errores[] = "El código debe ser un número de 6 dígitos.";
        }
    }
        private function mensajes($tipo,$mensaje){
            header("location: index.php?u=auth&".$tipo."=".$mensaje."");         
        }

        public function salir(){
            session_unset();
            session_destroy();
            header("Location:index.php?u=auth");
        }
    }  

?>