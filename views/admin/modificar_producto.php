        <?php 
            include "./template/header.php";
            if(!isset($_GET['p'])){
                header("location: catalogo.php");
            }else{
                $producto_url=$_GET['p'];
                if (ctype_digit($producto_url)) {
                    include_once("../libs/database.php");
                    $sysdb= new Database();
                    $producto = $sysdb->getProducto($producto_url);
                    if(!$producto){
                        header("location: catalogo.php?e=".urlencode("El producto seleccionado no existe."));
                    }else{
                        //var_dump($producto);
                    }
                }else{
                    header("location: catalogo.php");
                }
            }
        ?>
        
        <main class="product_edit">
        <form class="formProductoedit"  action="controllers/adminModifyproducto.php" method="post" enctype="multipart/form-data">
            <h2 id="tituloModal">Modificar Producto <?php echo $producto['nombre_producto'];?></h2>

            <label for="nombre">Ingrese el nombre del producto:</label>
            <input type="text" id="nombre" name="nombre" value="<?php echo $producto['nombre_producto'] ;?>">

            <label for="imagen">Ingrese la imagen del producto:</label>
            <input type="file" id="imagen" name="imagen" accept="image/*">
            <label for="descripcion">Ingrese la descripcion del producto:</label>
            <input type="text" id="descripcion" name="descripcion" value="<?php echo $producto['descripcion_producto'] ;?>">

            <label for="precio">Ingrese el precio del producto:</label>
            <input type="number" id="precio" name="precio" step="0.01" value="<?php echo $producto['precio'] ;?>">

            <label for="stock">Ingrese la cantidad de producto:</label>
            <input type="number" id="stock" name="stock" step="1" value="<?php echo $producto['stock'] ;?>">

            <input type="hidden" name="c" value="<?php echo($_GET['p']);?>">
            <div class="botones-modal">
                <button type="submit" id="btnGuardar" name="addProducto">Añadir</button>
                <button type="button" id="btnCancelar">Cerrar</button>
            </div>

        </form>
    </main>

    <?php  include "template/footer.php" ?>