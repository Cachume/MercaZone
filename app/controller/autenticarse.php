<?php
    require_once __DIR__ . '/../core/config.php';
    require_once("./app/models/authmodel.php");
    require_once("./app/models/newauthmodel.php");
    require_once("./app/core/mercamail.php");
    require_once("./app/core/utils.php");
    class Autenticarse{

        public $data;
        public function __construct(){}

        public function default(){
            global $client;
            $this->data= $client->createAuthUrl();
            require_once './app/views/auth/auth.php';
        }

        public function registrarme(){
            $_SESSION['register_data']=[];
            require_once './app/views/auth/register.php';
        }

        public function login(){
            if(isset($_POST['iniciarsesion'])){
                if(!isset($_POST['email']) && !isset($_POST['password'])){
                    UtilsZone::instaMessage('error',"Error en la Verificación","Todos los campos son obligatorios");
                    header('Location: ' . APP_URL . '/autenticarse');
                    return;
                }
                $correo = filter_input(INPUT_POST, 'email', FILTER_VALIDATE_EMAIL);
                $codigo = trim($_POST['password'] ?? '');

                $auth = Authmodel::loginUser($correo,'');
                if(is_null($auth)){
                    UtilsZone::instaMessage('error',"Error en la Verificación","Correo o Contraseña Incorrectos");
                    header('Location: ' . APP_URL . '/autenticarse');
                    return;
                }

                if(!password_verify($codigo,$auth['contrasena'])){
                    UtilsZone::instaMessage('error',"Error en la Verificación","Correo o Contraseña Incorrectos");
                    header('Location: ' . APP_URL . '/autenticarse');
                    return;
                }

                $_SESSION['id_user'] = $auth['id'];
                $_SESSION['nombre'] = $auth['nombre'];
                $_SESSION['apellidos'] = $auth['apellidos'];
                $_SESSION['correo'] = $auth['correo'];
                $_SESSION['cedula'] = $auth['cedula'];
                $_SESSION['rol'] = $auth['rol'];
                $_SESSION['type_dni'] = $auth['type_dni'];
                $_SESSION['imagen'] = $auth['foto_perfil'];
                $_SESSION['imagen'] = $auth['foto_perfil'];
                UtilsZone::instaMessage('success',"Verificación Completada","Bienvenid@ a MercaZone ".$_SESSION['nombre']);
                header('Location: ' . APP_URL . '/dashboard');
                return;

            }else{
                UtilsZone::instaMessage('error',"Error en la Verificación","Ha ocurrido un error intentalo mas tarde.");
                header('Location: ' . APP_URL . '/autenticarse');
                return;
            }
        }

        public function vldc4rnt(){
            header('Content-Type: application/json');
            $dni = $_POST['dni'] ?? null;
            $type_dni = $_POST['type_dni'] ?? null;
            if(!$dni || !$type_dni){
                if(!is_numeric($dni)){
                    echo json_encode(['valid'=> false, 'message' => 'Cédula inválida.']);
                    return;
                }
                if(strlen($dni) < 7 || strlen($dni) > 8){
                    echo json_encode(['valid'=> false, 'message' => 'Cédula inválida.']);
                    return;
                }
                if($type_dni !== 'V' && $type_dni !== 'E'){
                    echo json_encode(['valid'=> false, 'message' => 'Tipo de cédula inválido.']);
                    return;
                }
            }
            $data = [
                'dni' => $dni,
                'type_dni' => $type_dni
            ];
            $consulta = Authmodel::validarCedula($data);
            if($consulta === false){
                $_SESSION['register_data']['dni'] = $dni;
                $_SESSION['register_data']['type_dni'] = $type_dni;
                echo json_encode(['valid'=> true]);
                return;
            }else{
                echo json_encode(['valid'=> false, 'message' => 'Cédula ya registrada.']);
                return;
            }
        }

        public function vld3m41l(){
            header('Content-Type: application/json');
            $email = $_POST['email'] ?? null;
            if(!$email){
                echo json_encode(['valid'=> false, 'message' => 'Correo electrónico inválido.']);
                return;
            }
            $consulta = Authmodel::correoExiste($email);
            if($consulta === false){
                $_SESSION['register_data']['email'] = $email;
                echo json_encode(['valid'=> true]);
                return;
                
            }else{
                echo json_encode(['valid'=> false, 'message' => 'Correo ya registrado.']);
                return;
            }
        }

        public function registerUser(){
            header('Content-Type: application/json');
            $post = $_POST;
            $sessionre = $_SESSION['register_data'];
            $data_post = [
                'name'=>$post['nombre'],
                'lastname'=>$post['apellido'],
                'type_dni'=> $post['tipo-dni'],
                'dni' => $post['carnet'],
                'email' => $post['email'],
                'birthday' => $post['cumpleanos'],
                'rol' => 3,
                'token' => bin2hex(random_bytes(32)),
                'active' => 0];
            if($data_post['dni'] != $sessionre['dni'] && $data_post['email'] != $sessionre['email']){
                $message = ['valid' => false, 'message' => "Los Datos ingresados no coinciden."];
                echo json_encode($message);
                return;
            }
            $consultaemail = Authmodel::correoExiste($sessionre['email']);
            $data = [
                'dni' => $sessionre['dni'],
                'type_dni' => $sessionre['type_dni']
            ];
            $consultadni = Authmodel::validarCedula($data);

            if($consultaemail || $consultadni){
                $message = ['valid' => false, 'message' => "Correo o Cedula Incorrectos."];
                echo json_encode($message);
                return;
            }
            $register = NewAuthmodel::NewUser($data_post);
            if($register){
                $url= APP_URL."/autenticarse/confirmar?token=".$data_post['token'];
                $mail_message = "<div style='text-align: center; font-family: Arial, sans-serif; border: 1px solid #ccc; padding: 50px 80px; width: 400px; margin: auto; border-radius: 10px; background-color: #f9f9f9;'>
                <h1>
                    <span style='color:#00b45d;'>Merca<span style='color:#014651;'>Zone</span></span>
                </h1>
                <span style='text-decoration:none; font-weight: bold;'>Nos alegra tenerte en MercaZone</span>
                <p>Gracias por registrarte en nuestra plataforma, por favor preciona el boton para activar tu cuenta.</p>
                <a href='".$url."' style='display: inline-block; background-color: #00b45d; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none;'>Verificar cuenta</a>
                <!-- <strong style='font-size: 30px;'>ASPDMpmdk23r,</strong> -->
                <p>Gracias por registrarte en MercaZone. :3</p>
            </div>";
                if(Mercamail::sendMail($data_post['email'], "Verifica tu cuenta en MercaZone", $mail_message)){
                    $message = ['valid' => true, 'message' => "Todo Correcto."];
                    echo json_encode($message);
                    return; 
                }else{
                    $message = ['valid' => false, 'message' => "No se ha podido enviarte el correo de verificación."];
                    echo json_encode($message);
                    return;
                }
            }else{
                $message = ['valid' => false, 'message' => "No se ha podido registrarte, intentalo mas tarde."];
                echo json_encode($message);
                return;
            } 
            // $message = ['data_post'=> $post, 'data_session'=> $sessionre];
            // echo json_encode($message);
        }
       
        public function confirmar(){
            $token = $_GET['token'] ?? null;
            if(!$token){
                header("Location: /auth/login");
                return;
            }
            $newpassword = substr(str_shuffle('abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ0123456789!@#$%&*'), 0, 12);
            $hash = password_hash($newpassword, PASSWORD_BCRYPT);
            $confirm = NewAuthmodel::confirmAccount($token, $hash);
            if($confirm[0]){
                $mail_message = "
                <div style='text-align: center; font-family: Arial, sans-serif; border: 1px solid #ccc; padding: 50px 80px; width: 400px; margin: auto; border-radius: 10px; background-color: #f9f9f9;'>
                <h1>
                    <span style='color:#00b45d;'>Merca<span style='color:#014651;'>Zone</span></span>
                </h1>
                <span style='text-decoration:none; font-weight: bold;'>Tu cuenta ha sido activada.</span>
                <p>Para iniciar sesión utiliza los siguientes datos</p>
                <p><strong>Correo electronico: ".$confirm[1]."</strong></p>
                <p><strong>Contraseña: ".$newpassword."</strong></p>
                <!-- <a href='' style='display: inline-block; background-color: #00b45d; color: white; padding: 10px 20px; border-radius: 5px; text-decoration: none;'>Verificar cuenta</a> -->
                
                <p>Gracias por registrarte en MercaZone. :3</p>
            </div>
            ";
            if(Mercamail::sendMail($confirm[1], "Cuenta Verificada", $mail_message)){
                include_once './app/views/messages/successregister.php';
                return;
            }else{
                header("Location:".APP_URL."/autenticarse");
            }
            }else{
                header("Location:".APP_URL."/autenticarse");
            }
        }
    }
?>