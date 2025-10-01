<?php require_once "./app/views/template/header.php";?>
<main class="main-products">
        <div class="products-title">
            <h2><?=$nombre;?></h2>
            <p>Mostrando 4 de 4 productos</p>
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
                <div class="product-item" data-productid="1" id="product-item">
                    <div class="product-item-img" >
                        <img class="product-img" src="/MercaZone/assets/img/products/controller.png" alt="">
                    </div>
                    <div class="product-item-info">
                        <h3 class="product-item-title">Xbox Controller Edicion Limitada</h3>
                        <p class="product-item-price">$60 / 43.234Bs</p>
                        <p class="product-item-shortdescription">Xbox Wireless Controller, Color Gris</p>
                    </div>
                </div>
                <div class="product-item" data-productid="2" id="product-item">
                    <div class="product-item-img" >
                        <img src="/MercaZone/assets/img/products/xbox.png" alt="">
                    </div>
                    <div class="product-item-info">
                        <h3 class="product-item-title">Xbox Series X Galaxy Edition</h3>
                        <p class="product-item-price">$600 / 68.234Bs</p>
                        <p class="product-item-shortdescription">Xbox Series X Edicion Galaxias,  Color Negro</p>
                    </div>
                </div>
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
                    <form class="add-to-cart-form" action="">
                        <label for="quantity">Cantidad:</label>
                        <select class="quantity-select" name="quantity" id="quantity">
                            <option value="1">1</option>
                            <option value="2">2</option>
                            <option value="3">3</option>
                            <option value="4">4</option>
                            <option value="5">5</option>
                        </select>
                        <button type="submit" class="add-to-cart-button">Adquirir Producto</button>
                    </form>
                    <button class="report-product-button">Reportar producto</button>
                </div>
            </div>
        </div>
    </div>
    <script src="/MercaZone/assets/js/jquery.js"></script>
    <script src="/MercaZone/assets/js/products.js"></script>
    <script src="/MercaZone/assets/js/main.js"></script>
</body>
</html>