<?php include "template/header.php";

            if (isset($_GET['s']) || isset($_GET['e'])) {
                $class = isset($_GET['s']) ? "success" : "error";
                $message = isset($_GET['s']) ? htmlspecialchars($_GET['s']) : htmlspecialchars($_GET['e']);
                echo "<span class='$class'>$message</span>";
            }
        ?>
        <section class="historial-compras">
            <h2>Historial de Compras</h2>
            <table class="tabla-compras">
                <thead>
                    <tr>
                        <th>Referencia</th>
                        <th>Método de Pago</th>
                        <th>Fecha</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    <?php include('./controllers/adminCompras.php');?>
                </tbody>
            </table>
        </section>
        
        

        <div class="ventana-modal" id="ventanaModalAceptar">

            <div class="modal-contenido">

                <span class="cerrar-modal">&times;</span>

                <h2>¿Seguro de aceptar esta compra?</h2>

                <div class="detalles-compra">
                    <h3><strong>Datos de la comprassss</strong></h3>
                    <p><strong>Nombre:</strong> <span id="nombres">Deviam</span></p>
                    <p><strong>Apellido:</strong> Trusman<span id="apellidos"></span></p>
                    <p><strong>Teléfono:</strong><span id="telefono">+58 414-3512548</span></p>
                    <p><strong>Cédula/RIF:</strong><span id="cedula">J-23.245.111-7</span></p>
                    <p><strong>Correo:</strong> <span id="correo">asd@gmail.com</span></p>
                    <p><strong>COMPRAS REALIZADAS:</strong><span id="compras">
                    <ul>
                        <li>camisa</li>
                        <li>pantalones</li>
                    </ul></span></p>
                    <p><strong>Identificador de compra:</strong> <span id="referencia">12345</span></p>
                    <p><strong>Capture:</strong></p>
                    <img id="capture" src="../src/capture.png" alt="Captura de la Compra">
                    <br><br>
                    <p>¿Está seguro de aceptar esta compra?</p>
                    <button id="confirmarAceptar">Confirmar</button>
                </div>
            </div>
        </div>

        <div class="ventana-modal" id="ventanaModalRechazar">

            <div class="modal-contenido">

                <span class="cerrar-modal">&times;</span>

                <h2>Rechazar Compra</h2>

                <div class="detalles-compra">
                    <label for="motivoRechazo">Motivo del Rechazo:</label>
                    <textarea id="motivoRechazo" rows="4" cols="50"></textarea>
                    <button id="confirmarRechazo">Confirmar</button>
                </div>
                
            </div>
        </div>


<?php include "template/footer.php"?>