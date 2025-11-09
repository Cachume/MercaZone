<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/index.css">
    <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/normalize.css">
    <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/dashboardadmin.css">
    <link href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined" rel="stylesheet" />
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <title>MercaZone - Dashboard</title>
</head>
<body>
    <aside class="aside-dashboard">
        <header class="aside-title">
            <button class="header-action-btn-menu" id="toggle-aside-close-btn">
                <span class="material-symbols-outlined">menu</span>
            </button>
            <a class="aside-title-link" href="">
                <span>Merca</span>
                <span>Zone</span>
            </a>
            <span class="pn">Panel Administrador</span>
        </header>
        <ul class="aside-menu">
            <li class="aside-menu-item">
                <a class="aside-menu-link selected" href="" id="link-home" data-view="dashboard-main">
                    <span class="material-symbols-outlined">home</span>
                    <span class="aside-menu-link-text">Inicio</span>
                </a>
            </li>
            <li class="aside-menu-item">
                <a class="aside-menu-link" href="admin/usuarios" id="link-products" data-view="dashboard-products">
                    <span class="material-symbols-outlined">account_circle</span>
                    <span class="aside-menu-link-text">Usuarios</span>
                </a>
            </li>
            <li class="aside-menu-item">
                <a class="aside-menu-link" href="admin/verificaciones" id="link-purchases" data-view="dashboard-purchases">
                    <span class="material-symbols-outlined">badge</span>
                    <span class="aside-menu-link-text">Verificaciones</span>
                </a>
            </li>
            <li class="aside-menu-item">
                <a class="aside-menu-link" href="admin/categorias" id="link-settings" data-view="dashboard-settings">
                    <span class="material-symbols-outlined">category</span>
                    <span class="aside-menu-link-text">Categorias</span>
                </a>
            </li>
            <li class="aside-menu-item">
                <a class="aside-menu-link" href="admin/reportes" id="link-verification" data-view="dashboard-verification">
                    <span class="material-symbols-outlined">shield</span>
                    <span class="aside-menu-link-text">Reportes</span>
                </a>
            </li>
            <li class="aside-menu-item">
                <a class="aside-menu-link" href="admin/salir" id="link-logout" data-view="dashboard-logout">
                    <span class="material-symbols-outlined">logout</span>
                    <span class="aside-menu-link-text">Regresar</span>
                </a>
            </li>
        </ul>
    </aside>