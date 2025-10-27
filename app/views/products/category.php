<?php require_once "./app/views/template/header.php";?>
<main class="main-products">
        <div class="products-title">
            <h2><?=$nombre;?></h2>
            <p><strong>Mostrando <?=$totalProducts;?> de <?=$totalProducts;?> productos</strong></p>
        </div>
        <div class="products-filters">
            <select name="sort" id="sort">
                <option value="popularity">Más populares</option>
                <option value="price_low">Precio: Bajo a Alto</option>
                <option value="price_high">Precio: Alto a Bajo</option>
            </select>
        </div>
        <div class="products-container">
            <div class="products-items">
                <?php 
                    if(!$products):
                        echo "<p>No hay productos en esta categoría</p>";
                    else:
                    foreach($products as $product): ?>
                    <div class="product-item" data-productid="<?= $product['id'] ?>" id="product-item">
                        <div class="product-item-img" >
                            <img class="product-img" src="<?= APP_URL ?>/assets/img/products/<?= $product['image'] ?>" alt="">
                        </div>
                        <div class="product-item-info">
                            <h3 class="product-item-title"><?= $product['name'] ?></h3>
                            <p class="product-item-price">$<?= $product['price'] ?> / <?= $product['price']*172 ?>Bs</p>
                            <p class="product-item-shortdescription"><?= $product['description'] ?></p>
                        </div>
                    </div>
                <?php endforeach; endif; ?>
            </div>
            <aside class="products-categorys">
                <h4>Categorías</h4>
                <ul>
                    <li><a href="#">Accesorios</a></li>
                    <li><a href="#">Consolas</a></li>
                    <li><a href="#">Videojuegos</a></li>
                    <li><a href="#">Merchandising</a></li>
                    <li><a href="#">Hardware</a></li>
                    <li><a href="#">Otros</a></li>
                </ul>
            </aside>
        </div>
    </main>
    <div class="modal-universal" id="modal-product">
        <div class="modal-universal-body">
            <span class="material-symbols-outlined modal-close" id="modal-close">close</span>
            <div class="modal-product-info">
                <div class="product-info-img">
                    <img src="../img/controller.png" alt="">
                </div>
                <div class="product-info-data">
                    <div class="product-info-sold">Vendidos: 100</div>
                    <h3 class="product-info-title"></h3>
                    <p class="product-info-price"><span class="product-info-price-old"></span></p>
                    <div class="product-info-status">Disponible</div>
                    <p class="product-info-description"></p>
                    <p class="product-info-seller">Vendido por: <a href="">Tiendas XYZ</a></p>
                    <div class="add-to-cart-form" >
                        <label for="quantity">Cantidad:</label>
                        <select class="quantity-select" name="quantity" id="quantity">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        <button type="submit" id="buy-product" class="add-to-cart-button">Adquirir Producto</button>
                    </div>
                    <button class="report-product-button">Reportar producto</button>
                </div>
            </div>
        </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="<?= APP_URL ?>/assets/js/jquery.js"></script>
    <script src="<?= APP_URL ?>/assets/js/products.js"></script>
    <script src="<?= APP_URL ?>/assets/js/main.js"></script>
</body>
</html>