<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="/Mercazone/assets/css/index.css">
    <link rel="stylesheet" href="/Mercazone/assets/css/verificacion.css">
    <title>MercaZone | Verificación</title>
</head>

<body>
        <main class="verification-main">
        <div class="verification-title">
            <a href="">
                <span>Merca</span>
                <span>Zone</span>
            </a>
            <h2>Verificación de Identidad</h2>
        </div>
        <?php if (isset($_GET['r']) && $_GET['r'] === 'success'): ?>
            <div class="verification-approved">
                <h3>Verificación Aprobada</h3>
                <p>Tu cuenta ha sido verificada exitosamente. Ya puedes acceder a todas las funciones de la plataforma sin restricciones.</p>
                <p>Gracias por completar el proceso de verificación.</p>
                <button class="return-button" onclick="window.location.href='index.php?u=perfil'">Ir a mi perfil</button>
            </div>

        <?php elseif (isset($_GET['r']) && $_GET['r'] === 'error'): ?>
            <div class="verification-error">
                <h3>Verificación Rechazada</h3>
                <p>Tu solicitud de verificación no pudo ser aprobada. Es posible que la información o los documentos proporcionados no cumplan con los requisitos.</p>
                <p>Por favor, revisa los datos e intenta nuevamente con documentos legibles y correctos.</p>
                <button class="retry-button" onclick="window.location.href='index.php?u=verificacion'">Reintentar Verificación</button>
            </div>
        <?php else: ?>
        <div class="verification-container" id="verification-container">
            <p>
                Para proteger tu cuenta y brindarte acceso completo a nuestra plataforma, es necesario completar el
                proceso de verificación de identidad.
            </p>
            <p>
                <strong>Antes de continuar</strong>, asegúrate de tener a la mano:
            <ul>
                <li>📷 Una foto clara de tu <strong>cédula de identidad</strong> o <strong>pasaporte</strong> (ambos
                    lados si aplica).</li>
                <li>🤳 Una <strong>foto de perfil tuya reciente</strong>, en la que se vea claramente tu rostro.</li>
            </ul>
            </p>
            <p>
                Esta verificación es obligatoria y solo tomará unos minutos. Todos los datos proporcionados serán
                tratados con estricta confidencialidad.
            </p>
            <p class="confidential-note">
                🔐 Tu información solo será utilizada con fines de verificación de identidad.
            </p>
            <button class="verification-button" id="start-verification">Iniciar Verificación</button>
            <button class="verification-button" style="background: orange;" id="back-to-profile">Regresar al Perfil</button>
        </div>
        <div class="verification-form" id="verification-form-container">
            <form id="verification-form" method="post" action="index.php?u=verificacion&m=enviar" enctype="multipart/form-data">
                <!-- Tipo de documento -->
                <label for="document-type">Tipo de Documento</label>
                <select id="document-type" name="document-type" required onchange="toggleDocumentSides(this.value)">
                    <option value="">Seleccione una opción</option>
                    <option value="cedula">Cédula de Identidad</option>
                    <option value="pasaporte">Pasaporte</option>
                </select>

                <!-- Número de documento -->
                <label for="document-number">Número de Documento</label>
                <input type="text" id="document-number" name="document-number" required>

                <!-- Contenedor para cédula (ambos lados) -->
                <div id="cedula-fields" style="display: none;">
                    <label for="cedula-front">Foto del Frente de la Cédula</label>
                    <input type="file" id="cedula-front" name="cedula-front" accept=".jpg,.jpeg,.png" required>

                    <label for="cedula-back">Foto del Reverso de la Cédula</label>
                    <input type="file" id="cedula-back" name="cedula-back" accept=".jpg,.jpeg,.png" required>
                </div>

                <!-- Contenedor para pasaporte -->
                <div id="pasaporte-field" style="display: none;">
                    <label for="passport-file">Foto del Pasaporte</label>
                    <input type="file" id="passport-file" name="passport-file" accept=".jpg,.jpeg,.png,.pdf">
                </div>

                <!-- Foto de perfil -->
                <label for="selfie-file">Foto de Perfil (tu rostro claramente visible)</label>
                <input type="file" id="selfie-file" name="selfie-file" accept=".jpg,.jpeg,.png" required>

                <button type="submit" class="verification-button">Enviar Verificación</button>
            </form>
        </div>
     <?php endif; ?>
    </main>
    <script src="/MercaZone/assets/js/verification.js"></script>
</body>
</html>