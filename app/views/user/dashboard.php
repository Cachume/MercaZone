<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/index.css">
    <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/normalize.css">
    <link rel="stylesheet" href="<?= APP_URL ?>/assets/css/dashboard.css">
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
            <a class="aside-title-link" href="<?= APP_URL ?>/">
                <span>Merca</span>
                <span>Zone</span>
            </a>
        </header>
        <ul class="aside-menu">
            <li class="aside-menu-item">
                <a class="aside-menu-link selected" href="" id="link-home" data-view="dashboard-main">
                    <span class="material-symbols-outlined">home</span>
                    <span class="aside-menu-link-text">Inicio</span>
                </a>
            </li>
            <li class="aside-menu-item">
                <a class="aside-menu-link" href="" id="link-products" data-view="dashboard-products">
                    <span class="material-symbols-outlined">package_2</span>
                    <span class="aside-menu-link-text">Mis Productos</span>
                </a>
            </li>
            <li class="aside-menu-item">
                <a class="aside-menu-link" href="" id="link-purchases" data-view="dashboard-purchases">
                    <span class="material-symbols-outlined">attach_money</span>
                    <span class="aside-menu-link-text">Mis Compras</span>
                </a>
            </li>
            <li class="aside-menu-item">
                <a class="aside-menu-link" href="" id="link-orders" data-view="dashboard-orders">
                    <span class="material-symbols-outlined">shopping_cart</span>
                    <span class="aside-menu-link-text">Mis Pedidos</span>
                </a>
            </li>
            <li class="aside-menu-item">
                <a class="aside-menu-link" href="" id="link-settings" data-view="dashboard-settings">
                    <span class="material-symbols-outlined">settings</span>
                    <span class="aside-menu-link-text">Configuración</span>
                </a>
            </li>
            <li class="aside-menu-item">
                <a class="aside-menu-link" href="" id="link-verification" data-view="dashboard-verification">
                    <span class="material-symbols-outlined">shield</span>
                    <span class="aside-menu-link-text">Verificación</span>
                </a>
            </li>
            <li class="aside-menu-item">
                <a class="aside-menu-link" href="<?= APP_URL ?>/salir" id="link-logout" data-view="dashboard-logout">
                    <span class="material-symbols-outlined">logout</span>
                    <span class="aside-menu-link-text">Cerrar sesión</span>
                </a>
            </li>
        </ul>
    </aside>
    <main class="main-dashboard hidden" id="main-dashboard">
        <header class="header-dashboard">
            <button class="header-action-btn-menu" id="toggle-aside-btn">
                    <span class="material-symbols-outlined">menu</span>
            </button>
            <div class="header-dashboard-title">
                <h1 id="dashboard-title">Dashboard</h1>
                <span>28 de Agosto del 2025</span>
            </div>
            <div class="header-dashboard-actions">
                <button class="header-action-btn">
                    <span class="material-symbols-outlined">notifications</span>
                </button>
                <div class="header-dashboard-user">
                    <?php
                            if(!empty($_SESSION['imagen'])) {
                                echo '<img src="' . APP_URL . '/' . htmlspecialchars($_SESSION['imagen']) . '" alt="User" />';
                            } else {
                                echo '<img src="https://unavatar.io/' . htmlspecialchars($_SESSION['correo']) . '" alt="User" />';
                            }
                        ?>
                    <div class="header-dashboard-userdata">
                        <span class="dashboard-userdata-name">Hola, <?= $_SESSION['nombre'] . ' ' . $_SESSION['apellidos'] ?></span>
                        <span class="dashboard-userdata-secondary"><?=$_SESSION['correo']?></span>
                    </div>
                </div>
            </div>
        </header>
        <section class="dashboard-main" id="dashboard-main">
            <div class="dashboard-main-cards">
                <div class="dashboard-main-card yellow">
                    <h3>Compras Realizadas</h3>
                    <div class="dashboard-main-card-data">
                        <p>43</p>
                        <p>Compras en el mes</p>
                    </div>
                </div>
                <div class="dashboard-main-card">
                    <h3>Dinero Gastado</h3>
                    <div class="dashboard-main-card-data">
                        <p>$500</p>
                        <p>Gastados en el mes</p>
                    </div>
                </div>
                <div class="dashboard-main-card blue">
                    <h3>Ventas Realizadas</h3>
                    <div class="dashboard-main-card-data">
                        <p>0</p>
                        <p>Ventas en el mes</p>
                    </div>
                </div>
                <div class="dashboard-main-card green">
                    <h3>Dinero Ganado</h3>
                    <div class="dashboard-main-card-data">
                        <p>20$</p>
                        <p>Ganancias en el mes</p>
                    </div>
                </div>
            </div>
        </section>
        <section class="dashboard-products">
            <header class="dashboard-products-header">  
                <input type="text" class="dashboard-products-search" placeholder="Buscar producto..." />
                <select class="dashboard-products-filter">
                    <option value="todos">Todos</option>
                    <option value="disponibles">Disponibles</option>
                    <option value="agotados">Agotados</option>
                </select>
                <button class="header-action-btn" id="open-add-product-modal">
                    <span class="material-symbols-outlined">add</span>
                    <span>Agregar Producto</span>
                </button>
            </header>
            <table class="dashboard-products-table">
                <thead>
                    <tr>
                        <th>Nombre</th>
                        <th>Categoría</th>
                        <th>Precio</th>
                        <th>Stock</th>
                        <th>Vistas</th>
                        <th>Ventas</th>
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
        <section class="dashboard-purchases" id="dashboard-purchases" style="display: none;">
            <header class="dashboard-products-header">  
                <input type="text" class="dashboard-products-search" placeholder="Buscar compra..." />
            </header>
            <div class="purchases-list" id="purchases-list">
                <!-- <div class="purchase-item">
                    <div class="purchase-item-image">
                        <img src="../img/xbox.png" alt="Product 1" />
                    </div>
                    <div class="purchase-item-info">
                        <h3>Xbox Series X (Galaxy Edition)</h3>
                        <p>Vendedor: <a href="#">Tienda de Ejemplo</a></p>
                        <p>Categoría: Consolas</p>
                        <p>Precio Unitario: $500</p>
                        <p>Cantidad: 1</p>
                        <p>Precio Total: $500</p>
                    </div>
                    <div class="purchase-item-status">
                        <span class="status completed">Entregado</span>
                        <button class="details-btn" data-purchase-id="1">Ver Detalles</button>
                    </div>
                </div> -->
            </div>
        </section>
        <section class="dashboard-orders hidden" id="dashboard-orders">
            <header class="dashboard-products-header">  
                <input type="text" class="dashboard-products-search" placeholder="Buscar Pedido..." />
                <select class="dashboard-products-filter">
                    <option value="todos">Todos</option>
                    <option value="disponibles">Disponibles</option>
                    <option value="agotados">Agotados</option>
                </select>
                <!-- <button class="header-action-btn" id="open-add-product-modal">
                    <span class="material-symbols-outlined">add</span>
                    <span>Agregar Producto</span>
                </button> -->
            </header>
            <table class="dashboard-products-table">
                <thead>
                    <tr>
                        <th>Comprador</th>
                        <th>Producto</th>
                        <th>Monto</th>
                        <th>Cant Compradas</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody id="orders-table-body" class="dashboard-products-table-body">
                    <!-- <tr>
                        <td colspan="5" style="text-align: center; padding: 20px;">
                            No hay productos para mostrar.
                        </td>
                    </tr> -->
                </tbody>
            </table>
        </section>
        <section class="dashboard-chat" id="dashboard-chat" style="display: none;align-items: center;justify-content: center;">
            <div class="chat-list">
                <div class="chat-header">
                    <div class="chat-header-user">
                        <img src="" id="chat_user_img" alt="User" />
                        <div class="chat-header-userdata">
                            <span class="chat-userdata-name">Usuario</span>
                            <span class="chat-userdata-secondary">En línea</span>
                        </div>
                    </div>
                </div>
                <div class="chat-messages" id="chat-messages">
                    <div class="message">
                        
                    </div>  
                </div>  
                <div class="chat-input">
                    <input type="text" id="chat-message-input" placeholder="Escribe tu mensaje..." required />
                    <button type="submit" class="header-action-btn" id="send-message">
                        <span class="material-symbols-outlined">send</span>
                    </button>
                </div>
            </div>
        </section>
        <section class="dashboard-verification" style="display: none;">
            <div class="verification-novirified" style="display: none;">
                <div class="noverified-main">
                    <span class="material-symbols-outlined">report</span>
                    <h2>Oh! No estas verificado</h2>
                    <p>Para proteger tu cuenta y brindarte acceso completo a nuestra plataforma, es necesario completar el
                proceso de verificación de identidad.</p>
                        <p>Mas de <strong>3000</strong> personas estan verificadas</p>
                    <button id="verificarme">Verificarme</button>
                </div>
                <form id="verification-form" class="verification-form" enctype="multipart/form-data">
                    <h2>Verificación de Identidad</h2>
                    <label for="document-number">Número de Documento</label>
                    <input type="text" id="document-number" name="document-number" value="V-30506910" disabled required>

                    <div id="cedula-fields">
                        <label for="cedula-front">Foto del Frente de la Cédula</label>
                        <input type="file" id="cedula-front" name="cedula-front" accept=".jpg,.jpeg,.png" required>
                    </div>
                    <label>
                    <input type="checkbox" id="acepto">
                    Confirmo que los datos ingresados son correctos y coinciden con mi cédula de identidad.
                    </label>
                    <button type="submit" class="verification-button">Enviar Verificación</button>
                </form>
            </div>
            <div class="verification-verified" style="display: none;">
                <span class="material-symbols-outlined">verified_user</span>
                <h2>Felicitaciones</h2>
                <p>Tu proceso de verificación ha sido completado</p>
                <p>Ahora en tu perfil podras ver el check de verificado</p>
                <span class="verifieduser">
                    <span class="material-symbols-outlined">verified</span>
                </span>
            </div>
            <div class="verification-verified">
                <span class="material-symbols-outlined">hourglass</span>
                <h2>Estamos verificando tu Identidad</h2>
                <p>Este proceso puede tomar varias horas, al completarse la verificación</p>
            </div>
        </section>
    </main>
    <div class="modal-product">
        <div class="modal-product-body">
            <div class="modal-product-header">
            <h2 id="modal-product-title">Agregar Producto</h2>
            <div class="modal-product-header-btns">
                <button class="header-action-btn" id="add-product-btn">
                    <span class="material-symbols-outlined">check</span>
                    <span id="add-product-btn-text">Agregar Producto</span>
                </button>
            </div>
        </div>
        <form class="add-product" id="add-product-form">
            <div class="product-form-image">
                <img src="" alt="" id="product-image-preview"/>
                <label for="product-image">
                    <span class="material-symbols-outlined">upload</span>
                    <span>Subir Imagen</span>
                </label>
                <input type="file" accept="image/*" id="product-image" name="product-image" required hidden/>
            </div>
            <div class="product-form-data">
                <div class="product-form-data-header">
                    <h3>Información del Producto</h3>
                </div>
                <div class="product-form-data-groups">
                    <div class="product-form-data-group">
                        <label for="product-name">Nombre del Producto</label>
                        <input type="text" name="product-name" id="product-name" required />
                    </div>
                    <div class="product-form-data-group">
                        <label for="product-description">Descripción corta del Producto</label>
                        <input type="text" name="product-description" id="product-description" required />
                    </div>
                </div>
                <div class="product-form-data-groups">
                    <div class="product-form-data-group">
                        <label for="product-category">Categoría del Producto</label>
                        <select name="product-category" id="product-category" required>
                            <option value="" disabled selected>Selecciona una categoría</option>
                            <?php
                                foreach($this->data as $category){
                                    echo '<option value="'.$category['id'].'">'.$category['nombre'].'</option>';
                                }
                            ?>
                        </select>
                    </div>
                    <div class="product-form-data-group">
                        <label for="product-price">Precio del Producto</label>
                        <span>$</span>
                        <input type="text" name="product-price" id="product-price" required style="padding-left: 30px;"/>
                    </div>
                </div>
                <div class="product-form-data-groups">
                    <div class="product-form-data-group">
                        <label for="product-stock">Stock del Producto</label>
                        <input type="number" name="product-stock" id="product-stock" required />
                    </div>
                    <div class="product-form-data-group">
                        
                    </div>
                </div>
                <div class="product-form-data-group">
                    <label for="product-full-description">Descripción completa del Producto</label>
                    <textarea name="product-full-description" id="product-full-description" rows="4" required></textarea>
                </div>
            </div>
        </form>            
        </div>
    </div>
    <div class="modal-details">
        <div class="modal-details-body">
            <div class="modal-details-header">
                <h2 id="modal-details-title">Detalles de la Compra</h2>
                <div class="modal-details-header-btns">
                    <button class="header-action-btn" id="close-details-btn">
                        <span class="material-symbols-outlined">close</span>
                    </button>
                </div>
            </div>
            <div class="modal-details-content">
                <div class="modal-details-product">
                    <img src="../img/xbox.png" alt="Product 1" />
                    <h3>Xbox Series X (Galaxy Edition)</h3>
                </div>
                <div class="modal-details-product-info">
                        <h3>Información de la Compra</h3>
                        <p>Vendedor: <a href="#">Tienda de Ejemplo</a></p>
                        <p>Categoría: Consolas</p>
                        <p>Precio Unitario: $500</p>
                        <p>Cantidad: 1</p>
                        <p>Precio Total: $500</p>
                    </div>
                <div class="modal-details-status">
                    <h3>Estado de la Compra</h3>
                    <p>Estado Actual: <span class="status completed">Entregado</span></p>
                    <p>Fecha de Compra: 15 de Agosto del 2025</p>
                </div>
            </div>
        </div>
    </div>
    <div class="modal-universal" id="modal-product">
        <div class="modal-universal-body">
            <div class="chat-container">
                <div class="chat-header">
                    <h4>Xbox Shop - Xbox Series X</h4>
                     <span class="material-symbols-outlined modal-close" id="modal-close">close</span>
                </div>
                <div class="chat-messages" id="chat-messages">
                    <div class="message">
                        <div class="message-container received">
                            <span class="message-user">Tienda de Ejemplo</span>
                        <p class="message-text">Hola, ¿en qué puedo ayudarte?</p>
                        <span class="message-time">10:00 AM</span>
                        </div>
                    </div>
                    <div class="message">
                        <div class="message-container sent">
                            <span class="message-user">Tienda de Ejemplo</span>
                            <p class="message-text">Hola, ¿en qué puedo ayudarte?</p>
                            <span class="message-time">10:00 AM</span>
                        </div>
                    </div>
                    <div class="message">
                        <div class="message-container received">
                            <span class="message-user">Tienda de Ejemplo</span>
                        <p class="message-text">Hola, ¿en qué puedo ayudarte?</p>
                        <span class="message-time">10:00 AM</span>
                        </div>
                    </div>
                    <div class="message">
                        <div class="message-container received">
                            <span class="message-user">Tienda de Ejemplo</span>
                        <p class="message-text">Hola, ¿en qué puedo ayudarte?</p>
                        <span class="message-time">10:00 AM</span>
                        </div>
                    </div>
                </div>
                <form class="chat-input" id="chat-form">
                    <input type="text" id="chat-message-input" placeholder="Escribe tu mensaje..." required />
                    <button type="submit" class="header-action-btn">
                        <span class="material-symbols-outlined">send</span>
                    </button>
                </form>
            </div> 
        </div>
    </div>
    <script src="<?= APP_URL ?>/assets/js/jquery.js"></script>
    <script src="<?= APP_URL ?>/assets/js/dashboard/chat.js"></script>
    <script src="<?= APP_URL ?>/assets/js/dashboard/dashboard.js"></script>
    <?php
        if(isset($this->comando) && isset($this->comando['iscommand']) && $this->comando['iscommand']){
            echo "<script>".$this->comando['command']."</script>";
        }
    ?>
    <script src="<?= APP_URL ?>/assets/js/dashboard/products.js"></script>
    <script src="<?= APP_URL ?>/assets/js/dashboard/verification.js"></script>
</body>
</html>