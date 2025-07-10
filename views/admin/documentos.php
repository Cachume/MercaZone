        <?php include "template/header.php";
        ?>
        
        <main>
                        <div class="detalle-verificacion">
                <h2>📄 Detalles de Verificación del Usuario</h2>

                <div class="info-verificacion">
                    <p><strong>Correo:</strong> <?= htmlspecialchars($verificacion['correo']) ?></p>
                    <p><strong>Cédula:</strong> <?= htmlspecialchars($verificacion['cedula']) ?></p>
                    <p><strong>Tipo de Documento:</strong> <?= ucfirst($verificacion['tipo_documento']) ?></p>
                    <p><strong>Número de Documento:</strong> <?= htmlspecialchars($verificacion['numero_documento']) ?></p>
                    <p><strong>Estado:</strong> <?= ucfirst($verificacion['estado']) ?></p>
                </div>

                <div class="imagenes-verificacion">
                    <?php if ($verificacion['tipo_documento'] === 'cedula'): ?>
                        <div>
                            <p><strong>Frente de la Cédula:</strong></p>
                            <img src="<?= $verificacion['cedula_frontal'] ?>" alt="Frente de la cédula">
                        </div>
                        <div>
                            <p><strong>Reverso de la Cédula:</strong></p>
                            <img src="<?= $verificacion['cedula_reverso'] ?>" alt="Reverso de la cédula">
                        </div>
                    <?php elseif ($verificacion['tipo_documento'] === 'pasaporte'): ?>
                        <div>
                            <p><strong>Pasaporte:</strong></p>
                            <img src="<?= $verificacion['pasaporte']?>" alt="Pasaporte">
                        </div>
                    <?php endif; ?>

                    <div>
                        <p><strong>Foto de Perfil (Selfie):</strong></p>
                        <img src="<?= $verificacion['selfie_imagen']?>" alt="Selfie">
                    </div>
                </div>

                <div class="acciones-verificacion">
                    <!-- Aquí podrías agregar botones para aceptar/rechazar -->
                    <!-- Ejemplo:
                    <form method="post" action="acciones_verificacion.php">
                        <input type="hidden" name="usuario_id" value="<?= $usuarioId ?>">
                        <button name="accion" value="aceptar">Aceptar</button>
                        <button name="accion" value="rechazar">Rechazar</button>
                    </form>
                    -->
                </div>
            </div>
        </main>
<?php include "template/footer.php"?>