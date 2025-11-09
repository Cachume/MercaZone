<?php

use Google\Service\AdMob\App;

    require_once("./app/models/productmodel.php");
    $categories = Productmodel::getCategorys();
    if($categories === false) {
        $categories = [];
    }
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/swiper@12/swiper-bundle.min.css"/>
    <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/normalize.css">
    <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/index.css">
    <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/products.css">
    <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/dashboard.css">
    <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/oldindex.css">
    <link rel="icon" type="image/png" href="<?= APP_URL ?>/assets/img/favicon/favicon-96x96.png" sizes="96x96" />
    <link rel="icon" type="image/svg+xml" href="<?= APP_URL ?>/assets/img/favicon/favicon.svg" />
    <link rel="shortcut icon" href="<?= APP_URL ?>/assets/img/favicon/favicon.ico" />
    <link rel="apple-touch-icon" sizes="180x180" href="<?= APP_URL ?>/assets/img/favicon/apple-touch-icon.png" />
    <meta name="apple-mobile-web-app-title" content="MercaZone" />
    <link rel="manifest" href="<?= APP_URL ?>/assets/img/favicon/site.webmanifest" />
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
                    <div class="header-dashboard-user">
                        <?php
                            if(!empty($_SESSION['imagen'])) {
                                echo '<img src="'.APP_URL."/" . htmlspecialchars($_SESSION['imagen']) . '" alt="User" />';
                            }else {
                                echo '<img src="'.APP_URL.'/assets/uploads/sf.jpg" alt="User" />';
                            }
                        ?>
                    <div class="header-dashboard-userdata">
                        <span class="dashboard-userdata-name">Hola, <?= htmlspecialchars($_SESSION['nombre']) . ' ' . htmlspecialchars($_SESSION['apellidos']) ?></span>
                        <span class="dashboard-userdata-secondary"><?= htmlspecialchars($_SESSION['correo']) ?></span>
                    </div>

                </div>
                        <?php else: ?>
                        <a href="<?= APP_URL ?>/autenticarse">Iniciar Sesion</a>
                        <a href="<?= APP_URL ?>/autenticarse/registrarme">Registrarme</a>
                    <?php endif; ?>
                </div>
                
            </div>
        </div>
        <div class="header-buttom">
            <div class="header-buttom-nav">
                <ul class="header-buttom-nav-list">
                    <li class="header-buttom-nav-item"><a href="<?= APP_URL ?>/">Inicio</a></li>
                    <li class="header-buttom-nav-item"><a href="#">Categorías</a></li>
                    <?php if (isset($_SESSION['id_user'])): ?>
                        <li class="header-buttom-nav-item"><a href="<?= APP_URL ?>/dashboard">Mi Cuenta</a></li>
                    <?php endif; ?>
                    <?php foreach($categories as $category): ?>
                        <li class="header-buttom-nav-item"><a href="<?= APP_URL ?>/producto/categoria/<?= $category['id'] ?>"><?= $category['nombre'] ?></a></li>
                    <?php endforeach; ?>
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