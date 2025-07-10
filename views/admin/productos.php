        <?php 
            include "./template/header.php"
        ?>
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
                    <h2>Lista de [Producto]</h2>
                    <button id="agregarProducto" class="btn-agregar">Añadir Producto</button>
                </div>

                <table class="tabla_catalogo">

                    <thead>
                        <tr>
                            <td>Nombre</td>
                            <td>Imagen</td>
                            <td>Descripcion</td>
                            <td>Precio</td>
                            <td>Stock</td>
                            <td>Acciones</td>
                        </tr>
                    </thead>
                    <tbody>
                    <?php
                    if (isset($_GET['c'])) {
                        $valor = $_GET['c'] ?? '';
                        if (ctype_digit($valor)) { // Solo números positivos
                            $producto = (int)$valor;
                            include_once("../libs/database.php");
                            $sysdb= new Database();
                            $catalogo= $sysdb->getProductos($producto);
                            //var_dump($catalogo);
                            if($catalogo){
                                foreach ($catalogo as $value) {
                                    $id=$value['id_producto'];
                                    $nombre=$value['nombre_producto'];
                                    $total=$value['stock'];
                                    $imagen = $value['imagen_producto'];
                                    $descripcion = $value['descripcion_producto'];
                                    $precio = $value['precio'];
                                    echo('<tr class="tr_fila">');
                                    echo("<td>$nombre</td>");
                                    echo("<td><img src='../src/producto/$imagen' alt='Producto 1' class='imagen-producto'></td>");
                                    echo("<td>$descripcion</td>");
                                    echo("<td>$precio</td>");
                                    echo("<td><strong>".$total."</strong></td>");
                                    echo("<td class='td_acciones'>");
                                    echo('<a class="editar" href="modificar_producto.php?p='.$id.'"><i class="fas fa-edit"></i></a>');
                                    echo('<a class="eliminar"href="controllers/eliminarProducto.php?p='.$id.' "><i class="fas fa-trash"></i></a>');
                                    echo('</td>');
                                    echo('</tr>');
                                }
                            }
                            // exit();
                        }else{
                            header("location:catalogo.php");
                        }
                    }else{
                        header("location:catalogo.php");
                    }
                 ?>
                        <!-- <tr class="tr_fila">
                            <td>Producto 1</td>
                            <td><img src='../src/producto/franela.png' alt='Producto 1' class='imagen-producto'></td>
                            <td>Producto numero uno en el mundo</td>
                            <td>$10.00</td>
                            <td>50</td>
                            <td>
                                <button class="editar" onclick="abrirModalEditar(1)"><i class="fas fa-edit"></i></button>
                                <button class="eliminar" onclick="abrirModalEliminar(1)"><i class="fas fa-trash"></i></button>
                            </td>
                        </tr> -->
                    </tbody>
                </table>
            </div>
     </main>
    </div>
    <div class="ventanatema" id="modalProducto">

        <div class="fondotema"></div>
        <form id="formProducto"  action="controllers/adminProductos.php" method="post" enctype="multipart/form-data">

            <h2 id="tituloModal">Añadir Producto a [Producto]</h2>

            <label for="nombre">Ingrese el nombre del producto:</label>
            <input type="text" id="nombre" name="nombre" >

            <label for="imagen">Ingrese la imagen del producto:</label>
            <input type="file" id="imagen" name="imagen" accept="image/*">

            <label for="descripcion">Ingrese la descripcion del producto:</label>
            <input type="text" id="descripcion" name="descripcion" >

            <label for="precio">Ingrese el precio del producto:</label>
            <input type="number" id="precio" name="precio" step="0.01" >

            <label for="stock">Ingrese la cantidad de producto:</label>
            <input type="number" id="stock" name="stock" step="1" >
            
            <input type="hidden" name="c" value="<?php echo($_GET['c']);?>">
            <div class="botones-modal">
                <button type="submit" id="btnGuardar" name="addProducto">Añadir</button>
                <button type="button" id="btnCancelar">Cerrar</button>
            </div>

        </form>
    </div>

    
    <div class="ventanatema" id="modalEliminar">

        <div class="fondotema"></div>

        <form id="formEliminar">

            <h2>¿Eliminar Producto?</h2>
            <p id="mensajeEliminar">¿Estás seguro de que deseas eliminar este producto?</p>

            <div class="botones-modal">
                <button type="submit" id="btnEliminar">Eliminar</button>
                <button type="button" id="btnCancelarEliminar">Cancelar</button>
            </div>
            
        </form>
    </div>

    <?php  include "template/footer.php" ?>