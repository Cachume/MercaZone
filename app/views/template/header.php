<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="/MercaZone/assets/css/normalize.css">
    <link rel="stylesheet" href="/MercaZone/assets/css/index.css">
    <link rel="stylesheet" href="/MercaZone/assets/css/products.css">
    <link rel="stylesheet" href="/MercaZone/assets/css/dashboard.css">
    <link rel="icon" type="image/png" href="/MercaZone/assets/img/favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="/MercaZone/assets/img/favicon/favicon.svg" />
    <link rel="shortcut icon" href="/MercaZone/assets/img/favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="/MercaZone/assets/img/favicon/apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="MercaZone" />
    <link rel="manifest" href="/MercaZone/assets/img/favicon/site.webmanifest" />
    <title>MercaZone</title>
</head>
<header>
        <div class="header-top">
            <div class="header-top-left">
                <div class="sidebar-menu-button">
                    <span class="material-symbols-outlined">menu</span>
                </div>
                <h1>
                    <span style="color:#00b45d">Merca<span style="color:#014651">Zone</span></span>
                </h1>
            </div>
            <form class="header-top-center">
                <input type="search" placeholder="Buscar productos, marcas y más...">
                <button><span class="material-symbols-outlined">search</span></button>
            </form>
            <div class="header-top-right">
                <?php if (isset($_SESSION['id_user'])): ?>
                <div class="user-data">
                        <div class="user-data-img">
                            <img src="/MercaZone/assets/img/albert.jpg" alt="" srcset="" id="user-img">
                        </div>
                        <div class="user-options" id="user-options">
                            <div class="user-data2">
                                <div class="user-data2-img">
                                    <img src="/MercaZone/assets/img/albert.jpg" alt="" srcset="">
                                </div>
                                <div class="user-data2-info">
                                    <span class="correo">Albert Josue</span>
                                    <span class="cedula">Quintero Colina</span>
                                </div>
                            </div>
                            <ul class="user-options-list">
                                <li><a href="index.php?u=perfil">Perfil</a></li>
                                <?php
                                if (isset($_SESSION['id_user']) && $_SESSION['rol'] == "admin") {
                                    echo '<li><a href="index.php?u=admin">Panel de Administrador</a></li>';
                                }
                                ?>
                                <li><a href="index.php">Carrito</a></li>
                                <li><a href="index.php">Ordenes</a></li>
                                <li><a href="index.php?u=auth&m=salir">Cerrar sesión</a></li>
                            </ul>
                        </div>
                        <?php else: ?>
                        <a href="/MercaZone/autenticarse">Iniciar Sesion</a>
                        <a href="/MercaZone/autenticarse">Registrarme</a>
                    <?php endif; ?>
                </div>
                
            </div>
        </div>
        <div class="header-buttom">
            <div class="header-buttom-nav">
                <ul class="header-buttom-nav-list">
                    <li class="header-buttom-nav-item"><a href="#">Inicio</a></li>
                    <li class="header-buttom-nav-item"><a href="#">Categorías</a></li>
                    <li class="header-buttom-nav-item"><a href="#">Ofertas</a></li>
                    <li class="header-buttom-nav-item"><a href="#">Tecnologia</a></li>
                    <li class="header-buttom-nav-item"><a href="#">Ropa y Calzado</a></li>
                    <li class="header-buttom-nav-item"><a href="#">Deportes</a></li>
                    <li class="header-buttom-nav-item"><a href="#">Repuestos para Vehiculos</a></li>
                    
                    <!-- <li class="header-buttom-nav-item"><a href="#">Mi cuenta</a></li> -->
                </ul>
            </div>
        </div>
        <div class="sidebar">
            <div class="sidebar-header">
                <span class="material-symbols-outlined">close</span>
                <h2>Menú</h2>
            </div>
            <ul class="sidebar-list">
                <li class="header-buttom-nav-item"><span class="material-symbols-outlined">home</span><a href="#">Inicio</a></li>
                <li class="header-buttom-nav-item"><span class="material-symbols-outlined">percent</span><a href="#">Ofertas</a></li>
                <li class="header-buttom-nav-item"><span class="material-symbols-outlined">category</span><a href="#">Categorías</a></li>
                <li class="header-buttom-nav-item"><span class="material-symbols-outlined">account_circle</span><a href="#">Mi cuenta</a></li>
            </ul>
        </div>
    </header>