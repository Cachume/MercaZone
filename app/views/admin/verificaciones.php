<?php require_once "./app/views/template/headeradmin.php";?>
        
    <main class="main-dashboard hidden" id="main-dashboard">
        <header class="header-dashboard">
            <button class="header-action-btn-menu" id="toggle-aside-btn">
                    <span class="material-symbols-outlined">menu</span>
            </button>
            <div class="header-dashboard-title">
                <h1 id="dashboard-title">Verificaciones</h1>
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
            <table class="dashboard-products-table">
                <thead>
                    <tr>
                        <th>Correo</th>
                        <th>Cédula</th>
                        <th>Tipo de Documento</th>
                        <th>N° Documento</th>
                        <th>Estado</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="products-table-body" class="dashboard-products-table-body">
                    <!-- <tr>
                        <td colspan="5" style="text-align: center; padding: 20px;">
                            No hay productos para mostrar.
                        </td>
                    </tr> -->
                </tbody>
            </table>
        </section>
        
    <script src="<?= APP_URL ?>/assets/js/jquery.js"></script>
    <script src="<?= APP_URL ?>/assets/js/admin/verificaciones.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script src="<?= APP_URL ?>/assets/js/dashboard/graficos.js"></script>
</body>
</html>