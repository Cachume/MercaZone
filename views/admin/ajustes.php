<?php include "template/header.php";
    if (isset($_GET['s']) || isset($_GET['e'])) {
        $class = isset($_GET['s']) ? "success" : "error";
        $message = isset($_GET['s']) ? htmlspecialchars($_GET['s']) : htmlspecialchars($_GET['e']);
        echo "<span class='$class'>$message</span>";
    }

?>
    
        <div class="contenedor-ajustes">

            <div class="tarjeta">
                <h3><i class="fas fa-user-cog"></i> Configuración de Perfil</h3>
                <form class="formulario-ajustes">
                    <div class="rejilla-formulario">
                        <div>
                            <label>Nombre:</label>
                            <input type="text" value="Juan Guerrero">
                        </div>
                        <div>
                            <label>Correo:</label>
                            <input type="email" value="admin@maakstore.com">
                        </div>
                        <div>
                            <label>Foto de perfil:</label>
                            <input type="file" accept="image/*">
                        </div>
                    </div>
                    <button type="submit" class="boton-guardar">Actualizar</button>
                </form>
            </div>

            
            <div class="tarjeta">
                <h3><i class="fas fa-shield-alt"></i> Seguridad</h3>
                <form class="formulario-ajustes">
                    <div class="rejilla-formulario">
                        <div>
                            <label>Contraseña actual:</label>
                            <input type="password">
                        </div>
                        <div>
                            <label>Nueva contraseña:</label>
                            <input type="password">
                        </div>
                        <div>
                            <label>Confirmar contraseña:</label>
                            <input type="password">
                        </div>
                    </div>
                    <button type="submit" class="boton-guardar">Actualizar</button>
                </form>
            </div>

            
            <div class="tarjeta">
                <h3><i class="fas fa-database"></i> Copias de Seguridad</h3>
                <div class="opciones-respaldo">
                    <button class="boton-respaldo">
                        <i class="fas fa-download"></i> Generar Backup
                    </button>
                    <button class="boton-restaurar">
                        <i class="fas fa-upload"></i> Restaurar Backup
                    </button>
                </div>
            </div>

            
            <div class="tarjeta" id="dolar">
                <h3><i class="fas fa-dollar-sign"></i> Configuración Dólar BCV</h3>
                <form class="formulario-ajustes" method="post" action="controllers/adminUpdatedolar.php">
                    <div class="rejilla-formulario">
                        <div>
                            <label>Tasa actual del dólar BCV:</label>
                            <input type="number" step="0.01" placeholder="<?php echo $dolar['precio'];?>" id="tasaDolar" name="tasadolar">
                        </div>
                    </div>
                    <div class="opciones-dolar">
                        <button type="submit" class="boton-guardar" name="updatedolar">
                            Actualizar
                        </button>
                    </div>
                </form>
            </div>
        </div>

<?php include "template/footer.php"?>