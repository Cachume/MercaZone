        <?php include "template/header.php"?>
        <?php
            if (isset($_GET['s']) || isset($_GET['e'])) {
                $class = isset($_GET['s']) ? "success" : "error";
                $message = isset($_GET['s']) ? htmlspecialchars($_GET['s']) : htmlspecialchars($_GET['e']);
                echo "<span class='$class'>$message</span>";
            }
        ?>

        <main>
            <div class="verificacion-usuarios-container">
    <div class="tabla-header">
        <h2>Usuarios Pendientes de Verificación</h2>
    </div>

    <div class="tabla-scroll">
        <table class="tabla-verificacion">
            <thead>
                <tr>
                    <th>Correo</th>
                    <th>Cédula</th>
                    <th>Tipo de Documento</th>
                    <th>N° Documento</th>
                    <th>Estado</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($this->verificaciones as $ver): ?>
                <tr>
                    <td><?= htmlspecialchars($ver['correo']) ?></td>
                    <td><?= htmlspecialchars($ver['cedula']) ?></td>
                    <td><?= ucfirst($ver['tipo_documento']) ?></td>
                    <td><?= htmlspecialchars($ver['numero_documento']) ?></td>
                    <td>
                        <?php if ($ver['estado'] === 'pendiente'): ?>
                            <span style="color: orange; font-weight: bold;">Pendiente</span>
                        <?php elseif ($ver['estado'] === 'aceptado'): ?>
                            <span style="color: green; font-weight: bold;">Aceptado</span>
                        <?php else: ?>
                            <span style="color: red; font-weight: bold;">Rechazado</span>
                        <?php endif; ?>
                    </td>
                    <td>
                        <a href="index.php?u=admin&m=documentos&id=<?= $ver['usuario_id'] ?>" class="btn-ver">Ver Documentos</a>
                        <!-- Aquí podrías poner botones para Aceptar o Rechazar -->
                    </td>
                </tr>
            <?php endforeach; ?>
            </tbody>
        </table>
    </div>
</div>

        </main>

    </div>

<?php include "template/footer.php"?>