<?php
    require_once("models/authmodel.php");
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
        public function login(){
            if(isset($_POST["iniciarsesion"])){
                $datos = array(
                "correo"=> filter_input(INPUT_POST,'email',FILTER_VALIDATE_EMAIL),
                "password"=> $result = (isset($_POST['password'])) ? $_POST['password'] : '');
                $this->validarlogin($datos['correo'],$datos['password']);

                if (count($this->errores) > 0) {
                    $errores = $this->errores;
                    require_once("views/auth.php");
                    return;
                }else{
                    $auth = Authmodel::loginUser($datos['correo'],$datos['password']);
                    if ($auth){
                        // var_dump($auth);
                        if($auth['cuenta_bloqueada']){
                            echo "<br>Cuenta bloqueda";
                            $now = new DateTime();
                            $bloqueo = new DateTime($auth['tiempo_bloqueo']);
                            $intervalo = $bloqueo->diff($now)->i; // diferencia en minutos
                            if ($intervalo < 1){
                                $this->errores[] = "Cuenta bloqueada por 1 Minuto, intente mas tarde";
                                $errores = $this->errores;
                                require_once("views/auth.php");
                                return;
                            }else{
                                Authmodel::desbloquearCuenta($datos['correo']);
                                $auth['cuenta_bloqueada'] = 0;
                                $auth['intentos_fallidos'] = 0;
                            }
                        }else{
                            echo "no bloqueada<br>";
                            if(password_verify($datos['password'],$auth['contrasena'])){
                                Authmodel::actualizarIntentos($auth['correo'],0);
                                $_SESSION['id_user'] = $auth['id'];
                                $_SESSION['nombre'] = $auth['nombre'];
                                $_SESSION['apellidos'] = $auth['apellidos'];
                                $_SESSION['correo'] = $auth['correo'];
                                $_SESSION['cedula'] = $auth['cedula'];
                                $_SESSION['rol'] = $auth['rol'];
                                header('Location:/MercaZone');
                                return;
                            }else{
                                echo "contrasena no correcta<br>";
                                $intentos = $auth['intentos_fallidos'] + 1;
                                echo $intentos;
                                if($intentos >= 3){
                                    Authmodel::bloquearCuenta($datos['correo']);
                                    $this->errores[] = "Cuenta bloqueada por 1 Minuto";
                                }else{
                                    Authmodel::actualizarIntentos($datos['correo'],$intentos);
                                    $this->errores[] = "Correo o Contraseña Incorrectos.";
                                }
                                $errores = $this->errores;
                                require_once("views/auth.php");
                                return;
                            }
                        }
                    }else{
                        $this->errores[] = "Correo o Contraseña Incorrectos.";
                        $errores = $this->errores;
                        require_once("views/auth.php");
                        return;
                    }
                }
            }else{
                header("Location:index.php?u=auth");
            }
        }
        public function register(){
            if(isset($_POST["registro"])){
                $datos = array(
                "cedula"=> filter_input(INPUT_POST,'cedula',FILTER_VALIDATE_INT),
                "correo"=> filter_input(INPUT_POST,'emailr',FILTER_VALIDATE_EMAIL),
                "contrasena"=> $_POST['passwordr'],
                "contrasenac" => $_POST['passwordcr'],
                "rol"=> 'comprador');

                $this->validarRegistro($datos);

                if (Authmodel::cedulaExiste($datos['cedula']) || Authmodel::correoExiste($datos['correo'])) {
                    $this->errores[] = "Los datos proporcionados no pueden ser utilizados. Si ya tienes una cuenta, intenta recuperar el acceso.";
                }
                if (count($this->errores) > 0) {
                    $errores = $this->errores;
                    require_once("views/auth.php");
                    return;
                }else{
                    //Si no hay errores, registrar usuario
                    $datos['contrasena']=password_hash($datos['contrasena'], PASSWORD_DEFAULT);
                    if(Authmodel::registerUser($datos)){
                        $this->mensajesc =["success", "Usuario registrado correctamente"];
                        $this->default();
                    }else{
                        $this->errores[] = "En estos momentos no se ha podido registrar el usuario";
                        $errores = $this->errores;
                        require_once("views/auth.php");
                        return;
                    }
                }
            }else{
                header("Location:index.php?u=auth");
            }
            
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

        private function validarlogin($correo, $contrasena){
            
            if(empty($correo) AND empty($contrasena)){
                $this->errores[]="Todos los campos son requeridos";
            }
            if(strlen($correo)> 40){
                $this->errores[]="El campo correo tiene un maximo de 60 caracteres";
            }
            if(!filter_var($correo,FILTER_VALIDATE_EMAIL)){
                $this->errores[]="Correo electronico no valido";
            }
            if(strlen($contrasena) < 8 || strlen($contrasena) >30){
                $this->errores[]="La contraseña debe tener minimo 8 caracteres y maximo 30";
            }
           if (!preg_match('/^(?=.*[A-Za-z])(?=.*\d)(?=.*[.$%#])[A-Za-z\d.$%#]+$/', $contrasena)) {
            $this->errores[] = "La contraseña debe contener al menos una letra, un número y uno de los símbolos: . $ % #";
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