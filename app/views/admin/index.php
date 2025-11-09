<?php require_once "./app/views/template/headeradmin.php";?>
        
    <main class="main-dashboard hidden" id="main-dashboard">
        <header class="header-dashboard">
            <button class="header-action-btn-menu" id="toggle-aside-btn">
                    <span class="material-symbols-outlined">menu</span>
            </button>
            <div class="header-dashboard-title">
                <h1 id="dashboard-title">Panel Administrador</h1>
                <span>28 de Agosto del 2025</span>
            </div>
            <div class="header-dashboard-actions">
                <div class="header-dashboard-user">
                    <img src="https://unavatar.io/albertq703@gmail.com" alt="User" />
                    <div class="header-dashboard-userdata">
                        <span class="dashboard-userdata-name">Hola, Albert Quintero </span>
                        <span class="dashboard-userdata-secondary">albert@gmail.com</span>
                    </div>
                </div>
            </div>
        </header>
        <section class="dashboard-main" id="dashboard-main">
            <div class="dashboard-main-cards">
                <div class="card_buyer">
                    <div class="dashboard-main-card">
                    <h3>Compras Realizadas</h3>
                    <canvas id="comprasDiaChart"></canvas>
                </div>
                <div class="dashboard-main-card">
                    <h3>Dinero Gastado</h3>
                    <canvas id="dineroGastadoChart"></canvas>
                </div><br>
                </div>
            </div>
        </section>
        
    <script src="<?= APP_URL ?>/assets/js/jquery.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="<?= APP_URL ?>/assets/js/dashboard/graficos.js"></script>
</body>
</html>