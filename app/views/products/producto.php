<?php require_once "./app/views/template/header.php";?>
    <main class="main-main">
        <div class="product-main">
            <div class="modal-product-info main">
                <div class="product-info-img">
                    <img src="/assets/img/products/<?=$this->product_data['image']; ?>" alt="">
                </div>
                <div class="product-info-data">
                    <div class="product-info-sold">Vendidos: <?=$this->product_data['sales']; ?></div>
                    <h3 class="product-info-title"><?=$this->product_data['name']; ?></h3>
                    <p class="product-info-price">$<?=$this->product_data['price']; ?> / <?=$this->product_data['price']*250; ?>Bs<span class="product-info-price-old"></span></p>
                    <div class="product-info-status">Disponible</div>
                    <p class="product-info-description"><?=$this->product_data['description']; ?></p>
                    <p class="product-info-seller">Vendido por: <a href=""><?=$this->product_data['nombre'].' '.$this->product_data['apellidos']; ?></a></p>
                    <form class="add-to-cart-form" action="">
                        <label for="quantity">Cantidad:</label>
                        <select name="quantity" id="quantity">

                            <?php 
                            $stock = intval($this->product_data['stock']);
                            for ($i=1; $i <= $stock ; $i++) { 
                                echo "<option value='$i'>$i</option>";
                            } ?>
                        </select>
                        <button type="submit" class="add-to-cart-button">Agregar al carrito</button>
                    </form>
                    <button class="report-product-button">Reportar producto</button>
                </div>
            </div>
        </div>
        <div class="otros-tambien">
            <h2>Clientes que compraron este producto también compraron</h2>
            <div class="productos-vendidos">
                <?php foreach($this->products_more as $product): ?>
                    <div class="product-item" data-productid="<?= $product['id'] ?>" id="product-item">
                        <span class="sales"><?= $product['total_vendido']?> Vendidos</span>
                        <div class="product-item-img" >
                            <img class="product-img" src="<?= APP_URL ?>/assets/img/products/<?= $product['image'] ?>" alt="">
                        </div>
                        <div class="product-item-info">
                                <h3 class="product-item-title"><?= $product['name'] ?></h3>
                                <p class="product-item-price">$<?= $product['price'] ?> / <?= $product['price']*250 ?>Bs</p>
                        </div>
                    </div>
                <?php endforeach;?>
            </div>
        </div>
    </main>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>
    <script src="../js/carousel.js"></script>
</body>
</html>