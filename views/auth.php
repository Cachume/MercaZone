<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="/MercaZone/assets/css/normalize.css">
    <link rel="stylesheet" href="/MercaZone/assets/css/index.css">
    <link rel="stylesheet" href="/MercaZone/assets/css/auth.css">
    <script src="/MercaZone/assets/js/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>MercaZone | Autentificación</title>
</head>
<body>
    <main class="main-auth">
        <div class="auth-container">
            <div class="auth-header">
                    <h1>MercaZone</h1>
                    <div class="auth-header-buttons">
                        <button class="selected" id="login"><span class="material-symbols-outlined">account_circle</span>Iniciar Sesión</button>
                    |
                        <button id="register"><span class="material-symbols-outlined">person_add</span>Registrarse</button>
                    </div>
                    <p id="textform">Inicia sesión para continuar</p>
                </div>
                <div class="auth-info">
                    <?php if(isset($errores)) {
                            echo '<div class="auth-info-error">';
                            echo '<h4>Se han encontrado errores</h4><p>';
                            foreach($errores as $error) {?>
                            
                            <?php echo "$error<br>" ?>
                            
                            <?php echo '</p>';}
                            echo '</div>';
                        } elseif (isset($mensaje)) {
                            echo '<div class="auth-info-good">';
                            echo '<h4>Felicitaciones!</h4>';
                            echo "<p>".$mensaje[1]."</p>";
                            echo '</div>';
                        }
                    ?>
                </div>
            <div class="auth-forms">
                <form id="auth-login" class="auth-form auth-login" action="index.php?u=auth&m=login" method="POST">
                    <div class="auth-input-group">
                        <label for="email" class="auth-label"></label>
                        <span class="material-symbols-outlined">email</span>
                        <input type="email" id="email" name="email" class="auth-input" placeholder="Correo Electrónico:" required>
                    </div>

                    <div class="auth-input-group" id="code-group" style="display: none;">
                        <label for="codigo" class="auth-label"></label>
                        <span class="material-symbols-outlined">key</span>
                        <input type="text" id="codigo" name="password" class="auth-input" placeholder="Ingresa tu código de verificacion">
                    </div>

                    <div class="auth-forgot" id="forgot-link">
                        <a href="/auth/forgot-password">¿Olvidaste tu contraseña?</a>
                    </div>

                    <button name="iniciarsesion" type="submit" class="auth-button" id="login-btn">Iniciar sesión</button>
                    <button type="button" id="resend-btn" class="auth-button" style="display: none;">
                    Verificar Codigo
                    </button>
                    <button type="button" id="resendbtn" class="auth-button" style="display: none;">
                    Reenviar Codigo
                    </button>
                </form>
                <form id="auth-register" class="auth-form auth-register hidden" action="index.php?u=auth&m=register" method="POST">
                     <div class="auth-input-group">
                        <label for="email" class="auth-label"></label>
                        <span class="material-symbols-outlined">badge</span>
                        <input type="number" id="emailc" name="cedula" class="auth-input" placeholder="Cedula de Identidad:" required>
                    </div>
                    <div class="auth-input-group">
                        <label for="email" class="auth-label"></label>
                        <span class="material-symbols-outlined">email</span>
                        <input type="email" id="emailr" name="emailr" class="auth-input" placeholder="Correo Electronico:" required>
                    </div>
                      <div class="auth-input-group" id="codigo2" style="display: none;">
                        <span class="material-symbols-outlined">key</span>
                        <input type="text" id="codigo22" name="passwordr" class="auth-input" placeholder="Ingresa tu código de verificación">
                    </div>
                    <div class="auth-forgot">
                        <a href="/auth/forgot-password"></a>
                    </div>
                    <button type="submit" class="auth-button" name="registro">Registrarme</button>
                    <button type="button" id="resend-register-btn" class="auth-button" style="display: none;">
                    Reenviar Codigo
                    </button>
                </form>
            </div>
        </div>
    </main>
    <script src="/MercaZone/assets/js/auth.js"></script>
</body>
</html>