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
                <div class="product-item">
                    <div class="product-item-img">
                        <img src="/MercaZone/assets/img/products/controller.png" alt="">
                    </div>
                    <div class="product-item-info">
                        <h3 class="product-item-title">Xbox Controller Edicion Limitada</h3>
                        <p class="product-item-price">$60 / 43.234Bs</p>
                        <p class="product-item-shortdescription">Xbox Wireless Controller, Color Gris</p>
                    </div>
                </div>
                <div class="product-item">
                    <div class="product-item-img">
                        <img src="/MercaZone/assets/img/products/xbox.png" alt="">
                    </div>
                    <div class="product-item-info">
                        <h3 class="product-item-title">Xbox Series X Galaxy Edition</h3>
                        <p class="product-item-price">$600 / 68.234Bs</p>
                        <p class="product-item-shortdescription">Xbox Series X Edicion Galaxias,  Color Negro</p>
                    </div>
                </div>
                <div class="product-item">
                    <div class="product-item-img">
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
    <script src="/MercaZone/assets/js/main.js"></script>
</body>
</html>