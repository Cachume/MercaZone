        <?php 
            include "./template/header.php";
            include_once("./controllers/adminCatalogo.php");
            if (isset($_GET['s']) || isset($_GET['e'])) {
                $class = isset($_GET['s']) ? "success" : "error";
                $message = isset($_GET['s']) ? htmlspecialchars($_GET['s']) : htmlspecialchars($_GET['e']);
                echo "<span class='$class'>$message</span>";
            }
        ?>
        <main>
            
            <div class="tabla-catalogos">

                <div class="header-tabla">
                    <h2>Gestión de Catálogos</h2>
                    <button id="agregarCatalogo" class="btn-agregar">Agregar Catálogo</button>
                </div>

                <table class="tabla_catalogo">

                    <thead>
                        <tr>
                            <td>Nombre del Catálogo</td>
                            <td>Imagen</td>
                            <td>Número de Productos</td>
                            <td>Acciones</td>
                        </tr>
                    </thead>

                    <tbody>
                        <?php
                        include_once("../libs/database.php");
                        $sysdb= new Database();
                        $catalogo= $sysdb->getCatalogo();
                        if($catalogo){
                            //var_dump($catalogo);
                            foreach ($catalogo as $value) {
                                $id=$value['id_categoria'];
                                $nombre=$value['nombre_categoria'];
                                $total=$value['total_productos'];
                                $imagen=$value['imagen_categoria'];
                                echo('<tr class="tr_fila">');
                                echo('<td><a href="productos.php?c='.$id.'">'.$nombre.'</a></td>');
                                echo("<td><img src='../src/catalogo/$imagen' alt='Producto 1' class='imagen-producto'></td>");
                                echo("<td><strong>".$total."</strong></td>");
                                echo("<td>");
                                //echo("<button class='editar' onclick='abrirModalEditarCatalogo(2)'><i class='fas fa-edit'></i></button>");
                                echo('<a class="eliminar"href="controllers/eliminarCatalogo.php?c='.$id.' "><i class="fas fa-trash"></i></a>');
                                echo('</td>');
                                echo('</tr>');
                            }
                        }
                    ?>
                        <!-- <tr class="tr_fila">
                            <td><a href="productos2.php">Gorras</a></td>
                            <td><img src="../src/Gorras.png" alt="Producto 2" class="imagen-producto"></td>
                            <td>67</td>
                            <td>
                                <button class='editar' onclick='abrirModalEditarCatalogo(2)'><i class='fas fa-edit'></i></button>
                                <button class="eliminar" onclick="abrirModalEliminarCatalogo(2)"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr> -->

                    </tbody>

                </table>

            </div>

        </main>
    </div>

    
    <div class="ventanatema" id="modalCatalogo">

        <div class="fondotema"></div>

        <form id="formCatalogo" action="catalogo.php" method="post" enctype="multipart/form-data">

            <h2 id="tituloModalCatalogo">Agregar Catálogo</h2>
            <label for="nombreCatalogo">Ingrese el nombre del Catálogo:</label>
            <input type="text" id="nombreCatalogo" name="nombrecatalogo" required>

            <label for="imagenCatalogo">Ingrese la imagen del Catálogo:</label>
            <input type="file" id="imagenCatalogo" name="imagen_catalogo" required>

            <div class="botones-modal">
                <button type="submit" id="btnGuardarCatalogo"  name="addCatalogo">Añadir</button>
                <button type="button" id="btnCancelarCatalogo">Cerrar</button>
            </div>

        </form>
    </div>

    
    <div class="ventanatema" id="modalEliminarCatalogo">

        <div class="fondotema"></div>

        <form id="formEliminarCatalogo">

            <h2>¿Eliminar Catálogo?</h2>
            <p id="mensajeEliminarCatalogo">¿Estás seguro de que deseas eliminar este catálogo?</p>

            <div class="botones-modal">
                <button type="submit" id="btnEliminarCatalogo">Eliminar</button>
                <button type="button" id="btnCancelarEliminarCatalogo">Cancelar</button>
            </div>

        </form>
    </div>

    <?php  include "template/footer.php" ?>