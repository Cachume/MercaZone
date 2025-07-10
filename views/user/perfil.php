<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="/MercaZone/assets/css/normalize.css">
    <link rel="stylesheet" href="/MercaZone/assets/css/perfil.css">
    <link rel="stylesheet" href="/MercaZone/assets/css/main.css">
    <title>MercaZone | Perfil</title>
</head>
<body>
    <header class="header-index">
        <div class="header-index-top">
            <button class="btn-menu" id="btn-menu">
                <span class="material-symbols-outlined">menu</span>
            </button>
            <a href="">
                <span>Merca</span>
                <span>Zone</span>
            </a>
            <button class="btn-account">
                <span class="material-symbols-outlined">account_circle</span>
            </button>
            <div class="sub-menu-container" id="sub-menu-container">
                <div class="sub-menu" id="sub-menu">
                    <div class="sub-menu-title">
                        <button class="btn-menu" id="btn-close">
                            <span class="material-symbols-outlined">close</span>
                        </button>
                        <a href="">
                            <span style="color: #03d26f;">Me</span>
                            <span>nu</span>
                        </a>
                    </div>
                    <div class="sub-menu-search">
                        <input type="text" placeholder="Buscar...">
                        <button class="btn-search">
                            <span class="material-symbols-outlined">search</span>
                        </button>
                    </div>
                    <ul class="sub-menu-list">
                        <li><a href="">Inicio</a></li>
                        <li><a href="">Productos</a></li>
                        <li><a href="">Ofertas</a></li>
                        <li><a href="">Contacto</a></li>
                    </ul>
                </div>
                <div class="background"></div>
            </div>
        </div>
        <div class="header-index-desktop">
                <a href="" class="header-title">
                    <span>Merca</span>
                    <span>Zone</span>
                </a>
                <form class="header-top-center">
                    <input type="search" placeholder="Buscar productos, marcas y más...">
                    <button><span class="material-symbols-outlined">search</span></button>
                </form>
                <div class="user-data">
                        <div class="user-data-img">
                            <img src="/MercaZone/assets/img/albert.jpg" alt="" srcset="" id="user-img">
                        </div>
                        <div class="user-options" id="user-options">
                            <div class="user-data2">
                                <div class="user-data2-img">
                                    <img src="/MercaZone/assets/img/albert.jpg" alt="" srcset="">
                                </div>
                                <div class="user-data2-info">
                                    <span class="correo">Albert Josue</span>
                                    <span class="cedula">Quintero Colina</span>
                                </div>
                            </div>
                            <ul class="user-options-list">
                                <li><a href="index.php?u=auth&m=perfil">Perfil</a></li>
                                <li><a href="index.php?u=auth&m=carrito">Carrito</a></li>
                                <li><a href="index.php?u=auth&m=ordenes">Ordenes</a></li>
                                <li><a href="index.php?u=auth&m=salir">Cerrar sesión</a></li>
                                <li><a href="index.php?u=auth&m=soporte">Soporte</a></li>

                            </ul>
                        </div>
                </div>
        </div>
    </header>
    <main class="main-profile">
        <h2>Perfil de Usuario</h2>
        <div class="profile-container">
            <nav class="profile-nav">
                <ul>
                    <li><a href="#info" class="nav-link active">Información Personal</a></li>
                    <li><a href="#password" class="nav-link">Contraseña</a></li>
                    <li><a href="#verification" class="nav-link">Verificación</a></li>
                </ul>
            </nav>
            <div class="profile-content">
                <section id="info" class="profile-section-info" data-section="true">
                    <h3>Información Personal</h3>
                    <div class="info-alert">
                        <h3>Verificación de Cuenta Requerida</h3>
                        <p>Completa la Verificación de tu cuenta para acceder a todas las funciones y confirmar tus datos personales.</p>
                    </div>
                    <br><br>
                    <form>
                        <div class="profile-section-form-group">
                            <label for="name">Nombre:</label>
                            <input type="text" id="name" name="name" value="<?php echo $_SESSION['nombre'];?>" disabled>
                        </div>
                        <div class="profile-section-form-group">
                            <label for="email">Apellidos:</label>
                            <input type="text" id="lastname" name="lastname" value="<?php echo $_SESSION['apellidos'];?>" disabled>
                        </div>
                        <div class="profile-section-form-group">
                            <label for="email">Correo Electrónico:</label>
                            <input type="email" id="email" name="email" value="<?php echo $_SESSION['correo'];?>" disabled>
                        </div>
                        <div class="profile-section-form-group">
                            <label for="email">Cedula de Identidad:</label>
                            <input type="text" id="id" name="id" value="V-<?php echo $_SESSION['cedula'];?>" disabled>
                        </div>
                        <div class="profile-section-form-group">
                            <label for="email">Pais de Residencia:</label>
                            <input type="text" id="country" name="country" value="" disabled>
                        </div>
                        <div class="profile-section-form-group">
                            <label for="email">Ciudad:</label>
                            <input type="text" id="city" name="city" value="" disabled>
                        </div>
                    </form>
                </section>
                <section id="password" class="profile-section-password" data-section="true">
                    <h3>Contraseña</h3>
                    <form>
                        <div class="section-password-group">
                            <label for="current-password">Contraseña Actual:</label>
                            <input type="password" id="current-password" name="current-password">
                        </div>
                        <div class="section-password-group">
                            <label for="new-password">Nueva Contraseña:</label>
                            <input type="password" id="new-password" name="new-password">
                        </div>
                        <div class="section-password-group">
                            <label for="confirm-password">Confirmar Contraseña:</label>
                            <input type="password" id="confirm-password" name="confirm-password">
                        </div>
                        <button type="submit" class="btn-update-password">Actualizar Contraseña</button>
                    </form>
                </section>
                <section id="verification" class="profile-section-verification" data-section="true">
                    <?php
                        // var_dump($this->verificacion);
                        if (is_null(value: $this->verificacion)) {
                            // No ha enviado verificación aún
                            echo '
                            <div class="verification-alert">
                                <h3>Verificación de Cuenta Requerida</h3>
                                <p>Para garantizar la seguridad de tu cuenta y cumplir con nuestras políticas, es necesario que completes el proceso de verificación de identidad.</p>
                                <p>
                                    Por favor, sube una copia clara de tu <strong>documento de identidad oficial</strong> (cédula, pasaporte o licencia de conducir).
                                </p>
                                <p class="confidential-text">
                                    Tu información será tratada con total confidencialidad y solo será utilizada para fines de verificación.
                                </p>
                                <button class="verify-btn">Iniciar Verificación</button>
                            </div>';
                        } elseif ($this->verificacion === 'pendiente') {
                            // Verificación enviada pero aún no aceptada
                            echo '
                            <div class="verification-alert pending">
                                <h3> Verificación en Proceso</h3>
                                <p>Tu solicitud de verificación ha sido recibida correctamente y está siendo revisada por nuestro equipo.</p>
                                <p>
                                    Este proceso puede tardar hasta 48 horas hábiles. Te notificaremos por correo una vez que tu identidad sea verificada.
                                </p>
                                <p class="confidential-text">
                                    Gracias por tu paciencia. Tu información está protegida y se maneja con absoluta confidencialidad.
                                </p>
                            </div>';
                        } elseif ($this->verificacion === 'aceptado') {
                            // Verificación aprobada
                            echo '
                            <div class="verification-alert success">
                                <h3>Verificación Completada</h3>
                                <p>Tu identidad ha sido verificada exitosamente.</p>
                                <p>
                                    Ahora puedes disfrutar de todas las funciones de la plataforma con total seguridad y confianza.
                                </p>
                                <p class="confidential-text">
                                    ¡Gracias por completar el proceso de verificación!
                                </p>
                            </div>';
                        }
                    ?>

                </section>
                <section id="support" class="profile-section-problem" data-section="true">
                    <h3>Soporte</h3>
                    <form>
                        <label for="issue">Descripción del Problema:</label>
                        <textarea id="issue" name="issue"></textarea>
                    </form>
                </section>
            </div>
        </div>
    </main>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const links = document.querySelectorAll(".nav-link");
            const sections = document.querySelectorAll('[data-section="true"]');

            links.forEach(link => {
                link.addEventListener("click", (e) => {
                    e.preventDefault();

                    // Quitar clase activa de todos los enlaces
                    links.forEach(l => l.classList.remove("active"));
                    link.classList.add("active");

                    // Ocultar todas las secciones
                    sections.forEach(section => section.style.display = "none");

                    // Mostrar la sección correspondiente
                    const targetId = link.getAttribute("href").substring(1);
                    const targetSection = document.getElementById(targetId);
                    if (targetSection) {
                        targetSection.style.display = "flex";
                    }
                });
            });
        });
    </script>

    <script src="/MercaZone/assets/js/main.js"></script>
</body>
</html>