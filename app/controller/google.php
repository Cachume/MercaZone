<?php
    require_once __DIR__ . '/../core/config.php';
    require_once("./app/models/authmodel.php");
    class Google{

        public $data;
        public function __construct(){}

        public function default(){
            global $client;
            $this->data= $client->createAuthUrl();
            require_once './app/views/auth/auth.php';
        }

        public function callback(){
            global $client;
            $operation = false;
            if (isset($_GET['code'])) {
                $token = $client->fetchAccessTokenWithAuthCode($_GET['code']);
                if (!isset($token['error'])) {
                    $client->setAccessToken($token['access_token']);
                    $google_oauth = new Google\Service\Oauth2($client);
                    $google_account_info = $google_oauth->userinfo->get();  
                    //Datos Usuario
                    $name = $google_account_info->givenName;
                    $lastname = $google_account_info->familyName;
                    $picture = $google_account_info->picture;
                    $email_verified = $google_account_info->email;
                    $password = bin2hex(random_bytes(8));
                    $authuser = Authmodel::loginGoogle($email_verified);
                    if (!$authuser) {
                        // Registro de nuevo usuario
                        $data = [
                            "cedula" => null,
                            "correo" => $email_verified,
                            "contrasena" => password_hash($password, PASSWORD_BCRYPT),
                            "rol" => "comprador",
                            "nombre" => $name,
                            "apellido" => $lastname,
                            "foto_perfil" => $picture
                        ];
                        $registro = Authmodel::registerUser($data);
                        if ($registro === true) {
                            $authuser = Authmodel::loginGoogle($email_verified);
                            $_SESSION['id_user'] = $authuser['id'];
                            $_SESSION['nombre'] = $name;
                            $_SESSION['apellidos'] = $lastname;
                            $_SESSION['correo'] = $email_verified;
                            $_SESSION['cedula'] = $authuser['cedula'];
                            $_SESSION['rol'] = $authuser['rol'];
                            include_once './app/views/messages/successgoogle.php';
                            $operation = true;
                        } else {
                            include_once './app/views/messages/errorgoogle.php';
                            exit;
                        }
                    }else{
                        $_SESSION['id_user'] = $authuser['id'];
                        $_SESSION['nombre'] = $name;
                        $_SESSION['apellidos'] = $lastname;
                        $_SESSION['correo'] = $email_verified;
                        $_SESSION['cedula'] = $authuser['cedula'];
                        $_SESSION['rol'] = $authuser['rol'];
                        $_SESSION['type_dni'] = $authuser['type_dni'];
                        include_once './app/views/messages/successgoogle.php';
                        $operation = true;
                    }
                    if($operation){
                        $carpeta = 'assets/uploads/usersgoogle/';
                        if (!file_exists($carpeta)) {
                            mkdir($carpeta, 0777, true);
                        }
                        $nombreArchivo = 'user_' . md5($email_verified) . '.jpg';
                        $rutaDestino = $carpeta . $nombreArchivo;
                        $imagen = @file_get_contents($picture);
                        if ($imagen !== false) {
                            file_put_contents($rutaDestino, $imagen);
                            $_SESSION['imagen'] = $rutaDestino;
                            Authmodel::updateImg($email_verified,$rutaDestino);
                        } else {
                            $_SESSION['imagen'] = null; 
                        }
                    }
                    exit;
                } else {
                    include_once './app/views/messages/errorgoogle.php';
                    exit;
                }
            } else {
                include_once './app/views/messages/errorgoogle.php';
                exit;
            }
        }
    }
?>