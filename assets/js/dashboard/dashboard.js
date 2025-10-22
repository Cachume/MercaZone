$(document).ready(function() {
    // $(".dashboard-main").hide();
    // $(".dashboard-purchases").show();
    // ChangeNameDashboard("link-purchases");

    console.log("Dashboard listo");
    //Evento click en los links del aside menu
    $(".aside-menu-link").on("click", function(e){
        //Valor del id del link clickeado
        id_link=$(this).attr("data-view");
        old_link=$(".aside-menu-link.selected").attr("data-view");

        e.preventDefault();
        $("." + old_link).hide();
        $("." + id_link).css("display", "flex");

        // console.log("Anterior:" + old_link + ", Nuevo:" + id_link);
        $(".aside-menu-link").removeClass("selected");
        $(this).addClass("selected");
        ChangeNameDashboard($(this).attr("id"));
    });

    //Evento click para mostrar/ocultar el aside menu
    $("#toggle-aside-btn") .on("click", function(){
        if($("aside").css("left") === "-250px"){
            $("aside").css("left", "0px");
            $(".main-dashboard").addClass("hidden");
        }
    });

    $("#toggle-aside-close-btn") .on("click", function(){
        if($("aside").css("left") === "0px"){
            $("aside").css("left", "-250px");
            $(".main-dashboard").removeClass("hidden");
        }
    });

    $("#view-details-btn").on("click", function(){
        $('.modal-details').css('display', 'flex');
    });

    $(".modal-details").on("click", function(e) {
        if ($(e.target).is(".modal-details")) {
            $(this).hide();
        }
    });
    $('#close-details-btn').on('click', function() {
        $('.modal-details').hide();
    });
});

function ChangeNameDashboard(name){
    var viewName = "";
    switch (name) {
        case "link-products":
            viewName = "Mis productos";
            loadProducts();
            break;
        case "link-purchases":
            viewName = "Mis compras";
            loadPurchases();
            break;
        case "link-settings":
            viewName = "Configuraciones";
            break;
        case "link-verification":
            viewName = "Verificación";
            break;
        case "link-orders":
            viewName = "Mis pedidos";
            loadOrders();
            break;
        case "link-logout":
            viewName = "Cerrar sesión";
            Swal.fire({
                icon: 'success',
                title: 'Sesión cerrada',
                text: 'Has cerrado sesión correctamente, esperamos verte pronto de nuevo.',
                showConfirmButton: false,
                timer: 1500
            }).then(() => {
                Swal.fire({
                icon: 'info',
                title: 'Redirigiendo...',
                text: 'Serás enviado a la página principal.',
                showConfirmButton: false,
                timer: 1500
                });
                setTimeout(() => {
                window.location.href = '/MercaZone/salir';
                }, 2000);
            });
            break;
        default:
            viewName = "Dashboard";
            break;
    }
    $("#dashboard-title").text(viewName);
}

function loadOrders(){
    fetch('http://localhost/MercaZone/dashboard/getMyOrders')
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if(data.success === true){
                const ordersTableBody = $('#orders-table-body');
                ordersTableBody.empty(); // Limpiar la tabla antes de agregar nuevos pedidos
                data.orders.forEach(order => {
                    if(order.buyer_image == null || order.buyer_image == ''){
                        order.buyer_image = 'https://unavatar.io/'+order.buyer_email;
                    }else{
                        order.buyer_image = "/MercaZone/assets/img/users/"+order.buyer_image;
                    }
                    const orderRow = `
                        <tr>
                            <td><img class="buyer-image" src="${order.buyer_image}" alt=""> ${order.buyer_name+" "+order.buyer_lastname}</td>
                            <td>${order.product_name}</td>
                            <td>$${order.price}</td>
                            <td>${order.amount} Unidad(es)</td>
                            <td >
                                <button class="header-action-btn-chat" data-id="${order.id}">
                                    <span  class="material-symbols-outlined">chat</span>
                                </button>
                            </td>
                        </tr>
                    `;
                    ordersTableBody.append(orderRow);
                });
            }
        })
        .catch(error => {
            console.error('Error al cargar los pedidos:', error);
            Swal.fire({
                icon: 'error',
                position : 'top-end',
                title: 'Error',
                text: 'No se pudieron cargar los pedidos.',
                showConfirmButton: false,
                timer: 1500
            });
        });

        $(".header-action-btn-chat").on("click", function(){
            $('.modal-universal').css('display', 'flex');
        });
        
        $('.modal-universal').on('click', function(e) {
                if (e.target === this) {
                    $(this).fadeOut();
                }   
            });
}

function loadProducts(){
    fetch('http://localhost/MercaZone/dashboard/getMyProducts')
        .then(response => response.json())
        .then(data => {
            if(data.success === true){
                const productsTableBody = $('#products-table-body');
                productsTableBody.empty(); // Limpiar la tabla antes de agregar nuevos productos
                data.products.forEach(product => {
                    const productRow = `
                        <tr>
                            <td><img src="/MercaZone/assets/img/products/${product.image}" class="product-image" alt=""> ${product.name}</td>
                            <td>${product.category}</td>
                            <td>$${product.price}</td>
                            <td>${product.stock}</td>
                            <td>${product.view}</td>
                            <td>${product.sales}</td>
                            <td >
                                <button class="header-action-btn-edit" data-id="${product.id}">
                                    <span  class="material-symbols-outlined">edit</span>
                                </button>
                                <button class="header-action-btn-delete" data-id="${product.id}">
                                    <span class="material-symbols-outlined">delete</span>
                                </button>
                            </td>
                        </tr>
                    `;
                    productsTableBody.append(productRow);
                });
            }
        })
        .catch(error => {
            console.error('Error al cargar los productos:', error);
            Swal.fire({
                icon: 'error',
                position : 'top-end',
                title: 'Error',
                text: 'No se pudieron cargar los productos.',
                showConfirmButton: false,
                timer: 1500
            })//.then(() => {location.reload();});
        });
}
function loadPurchases(){
    fetch('http://localhost/MercaZone/dashboard/getMyPurchases')
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if(data.success === true){
                const purchasesdiv = $('#purchases-list');
                purchasesdiv.empty(); // Limpiar la tabla antes de agregar nuevos productos
                data.purchases.forEach(purchase => {
                    const purchaseRow = `
                <div class="purchases-list-item">
                    <div class="purchase-item-image">
                        <img src="/MercaZone/assets/img/products/${purchase.image}" alt="${purchase.product_name}" />
                    </div>
                    <div class="purchase-item-details">
                        <h3>${purchase.name}</h3>
                        <p>Cantidad: ${purchase.cantidad} Unds</p>
                        <p>Precio: $${purchase.price}</p>
                        <p>Fecha de compra: ${purchase.creado_en}</p>
                        <p>Estado: <span class="status ${purchase.status}">${purchase.estado.charAt(0).toUpperCase() + purchase.estado.slice(1)}</span></p>
                        <div class="purchase-item-actions">
                            <button class="purchase-action-btn" id="view-details-btn">
                                <span class="material-symbols-outlined"></span>
                                <span>Ver Detalles</span>
                            </button>
                            <button class="purchase-action-btn-secondary">
                                <span class="material-symbols-outlined"></span>
                                <span>Mensajes</span>
                            </button>
                        </div>
                    </div>
                </div>
                    `;
                    purchasesdiv.append(purchaseRow);
                });
            }
        })
        .catch(error => {
            console.error('Error al cargar las compras:', error);
            Swal.fire({
                icon: 'error',
                position : 'top-end',
                title: 'Error',
                text: 'No se pudieron cargar las compras.',
                showConfirmButton: false,
                timer: 1500
            });
        });
}