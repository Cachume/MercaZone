<?php require_once "./app/views/template/header.php";?>
<main class="principal">
        <div class="swiper">
            <div class="swiper-wrapper">
                <div class="swiper-slide">
                    <img class="slider-image" src="<?= APP_URL ?>/assets/img/banners/banner1.png" alt="">
                </div>
                <div class="swiper-slide">
                    <img class="slider-image" src="<?= APP_URL ?>/assets/img/banners/banner2.png" alt="">
                </div>
                <div class="swiper-slide">
                    <img class="slider-image" src="<?= APP_URL ?>/assets/img/banners/banner3.png" alt="">
                </div>
                <div class="swiper-slide">
                    <img class="slider-image" src="<?= APP_URL ?>/assets/img/banners/banner4.png" alt="">
                </div>
                <div class="swiper-slide">
                    <img class="slider-image" src="<?= APP_URL ?>/assets/img/banners/banner5.png" alt="">
                </div>
            </div>
        </div>
        <div class="categorys">
            <h2>¿Que estas buscando?</h2>
            <div class="categorys-item">
                <a href="/producto/categoria/3" class="category-item">
                    <span class="material-symbols-outlined">laptop</span>
                    <p>Computadoras y Laptops</p>
                </a>
                <a href="/producto/categoria/4" class="category-item">
                    <span class="material-symbols-outlined">mobile_2</span>
                    <p>SmartPhones</p>
                </a>
                <a href="/producto/categoria/1" class="category-item">
                    <span class="material-symbols-outlined">headphones</span>
                    <p>Accesorios</p>
                </a>
                <a href="#" class="category-item">
                    <span class="material-symbols-outlined">watch</span>
                    <p>Relojes</p>
                </a>

                <a href="#" class="category-item">
                    <span class="material-symbols-outlined">tv</span>
                    <p>Televisores</p>
                </a>

                <a href="/producto/categoria/2" class="category-item">
                    <span class="material-symbols-outlined">videogame_asset</span>
                    <p>Consolas</p>
                </a>
            </div>
        </div>
        <h1>La Mejor Seleccion para Ti</h1>
        <section class="principal-descubre">
            <div class="descubre-item">
                <div class="descubre-item-data">
                    <p>Los mejor para el Gamer</p>
                    <a href="">Ver mas</a>
                </div>
                <div class="descubre-item-img">
                    <img src="<?= APP_URL ?>/assets/img/products/descubrir1.png" alt="">
                </div>
            </div>
            <div class="descubre-item">
                <div class="descubre-item-data">
                    <p>Lleva tu musica a otro nivel</p>
                    <a href="">Ver mas</a>
                </div>
                <div class="descubre-item-img">
                    <img src="<?= APP_URL ?>/assets/img/products/audifonos.png" alt="">
                </div>
            </div>
            <div class="descubre-item">
                <div class="descubre-item-data">
                    <p>Encuentra la mejor camisa para tu Outfit</p>
                    <a href="">Ver mas</a>
                </div>
                <div class="descubre-item-img">
                    <img src="<?= APP_URL ?>/assets/img/products/camisa.png" alt="">
                </div>
            </div>
            <div class="descubre-item">
                <div class="descubre-item-data">
                    <p>Repuestos para tu vehiculo</p>
                    <a href="">Ver mas</a>
                </div>
                <div class="descubre-item-img">
                    <img src="<?= APP_URL ?>/assets/img/products/motor.png" alt="">
                </div>
            </div>
        </section>
        <section class="principal-descuentos">
            <div class="descuentos-title">
                <p>Productos en descuentos</p>
                <a href="">Ver todos</a>
            </div>
            <div class="product-item small">
                <div class="product-item-img">
                    <img src="<?= APP_URL ?>/assets/img/products/controller.png" alt="">
                </div>
                <div class="product-item-info">
                    <h3 class="product-item-title">Xbox Controller Edicion Limitada</h3>
                    <p class="product-item-price">$60 / 43.234Bs</p>
                </div>
            </div>
            <div class="product-item small">
                <div class="product-item-img">
                    <img src="<?= APP_URL ?>/assets/img/products/xbox.png" alt="">
                </div>
                <div class="product-item-info">
                    <h3 class="product-item-title">Xbox Series X Galaxy Edition</h3>
                    <p class="product-item-price">$600 / 68.234Bs</p>
                </div>
            </div>
            <div class="product-item small">
                <div class="product-item-img">
                    <img src="<?= APP_URL ?>/assets/img/products/xbox.png" alt="">
                </div>
                <div class="product-item-info">
                    <h3 class="product-item-title">Xbox Series X Galaxy Edition</h3>
                    <p class="product-item-price">$600 / 68.234Bs</p>
                </div>
            </div>
            <div class="product-item small">
                <div class="product-item-img">
                    <img src="<?= APP_URL ?>/assets/img/products/xbox.png" alt="">
                </div>
                <div class="product-item-info">
                    <h3 class="product-item-title">Xbox Series X Galaxy Edition</h3>
                    <p class="product-item-price">$600 / 68.234Bs</p>
                </div>
            </div>
        </section>
    </main>
    <script src="<?= APP_URL ?>/assets//js/main.js?v=<?php echo time();?>"></script>
    <script src="https://unpkg.com/scrollreveal"></script>
    <script src="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.js"></script>
    <script src="<?= APP_URL ?>/assets/js/carousel.js"></script>
</body>
</html>