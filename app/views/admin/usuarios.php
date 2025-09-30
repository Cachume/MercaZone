        <?php include "template/header.php"?>
        <?php
            if (isset($_GET['s']) || isset($_GET['e'])) {
                $class = isset($_GET['s']) ? "success" : "error";
                $message = isset($_GET['s']) ? htmlspecialchars($_GET['s']) : htmlspecialchars($_GET['e']);
                echo "<span class='$class'>$message</span>";
            }
        ?>

        <main>
            <div class="tabla-productos">

                <div class="header-tabla">
                    <h2>Lista de Usuarios</h2>
                </div>

                <table class="tabla_catalogo">
                    <thead>
                        <tr>
                            <td>Correo Electronico</td>
                            <td>Cedula de Identidad</td>
                            <td>Administrador</td>
                            <td>Gestionar</td>
                        </tr>
                    </thead>

                    <tbody>
                        <!-- Datos de ejemplo -->
                        <?php include("controllers/adminUsuarios.php");?>
                    </tbody>

                </table>
            </div>

        </main>

    </div>

<?php include "template/footer.php"?>