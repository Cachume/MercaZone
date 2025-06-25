<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <link rel="stylesheet" href="/MercaZone/assets/css/normalize.css">
    <link rel="stylesheet" href="/MercaZone/assets/css/index.css">
    <title>MercaZone</title>
</head>
<body>
    <header>
        <div class="header-top">
            <div class="header-top-left">
                <div class="sidebar-menu-button">
                    <span class="material-symbols-outlined">menu</span>
                </div>
                <a href="#">MercaZone</a>
            </div>
            <form class="header-top-center">
                <input type="search" placeholder="Buscar productos, marcas y más...">
                <button><span class="material-symbols-outlined">search</span></button>
            </form>
            <div class="header-top-right">
                <div class="user-options">
                    <?php if (isset($_SESSION['id_user'])): ?>
                        <div class="user-data">
                            <div class="user-data-img">
                                <img src="/MercaZone/assets/img/albert.jpg" alt="" srcset="">
                            </div>
                            <div class="user-data-info">
                                <span class="correo"><?php echo $_SESSION['correo'];?></span>
                                <span class="cedula">V-<?php echo $_SESSION['cedula'];?></span>
                            </div>
                            <a href="index.php?u=auth&m=salir">
                                <span class="material-symbols-outlined">logout</span>
                            </a>
                        </div>
                    <?php else: ?>
                        <a href="index.php?u=auth"><span class="material-symbols-outlined">person</span></a>
                    <?php endif; ?>
                    
                </div>
            </div>
        </div>
        <div class="header-buttom">
            <div class="header-buttom-nav">
                <ul class="header-buttom-nav-list">
                    <li class="header-buttom-nav-item"><a href="#">Inicio</a></li>
                    <li class="header-buttom-nav-item"><a href="#">Ofertas</a></li>
                    <li class="header-buttom-nav-item"><a href="#">Categorías</a></li>
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
</body>
</html>