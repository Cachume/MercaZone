$(document).ready(function() {
    // $(".dashboard-main").hide();
    // $(".dashboard-purchases").show();
    // ChangeNameDashboard("link-purchases");\
    console.log("Dashboard listo");
    //Evento click en los links del aside menu
    $(".aside-menu-link").on("click", function(e){
        //Valor del id del link clickeado
        $(".dashboard-chat").hide();
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

    $('#export-sell').on('click', function (){  
        const popup = window.open("/reportes/ventas ", "_blank");
        setTimeout(() => {
            popup.close();
        }, 3000);
    })
    $('#export-sellcategory').on('click', function (){  
        const popup = window.open("/reportes/ventasporcategoria", "_blank");
        setTimeout(() => {
            popup.close();
        }, 3000);
    })
    loadDataMain();

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
                window.location.href = '/salir';
                }, 2000);
            });
            break;
        case "link-chat":
            viewName = "Chat";
            break;
        default:
            viewName = "Dashboard";
            break;
    }
    $("#dashboard-title").text(viewName);
}

function loadOrders(){
    fetch(`/dashboard/getMyOrders`)
        .then(response => response.json())
        .then(data => {
            if(data.success === true){
                const ordersTableBody = $('#orders-table-body');
                ordersTableBody.empty(); // Limpiar la tabla antes de agregar nuevos pedidos
                data.orders.forEach(order => {
                    if(order.buyer_image == null || order.buyer_image == ''){
                        order.buyer_image = 'https://unavatar.io/'+order.buyer_email;
                    }else{
                        order.buyer_image = "/"+order.buyer_image;
                    }
                    const orderRow = `
                        <tr>
                            <td><img class="buyer-image" src="${order.buyer_image}" alt=""> ${order.buyer_name+" "+order.buyer_lastname}</td>
                            <td>${order.product_name}</td>
                            <td>$${order.price}</td>
                            <td>${order.amount} Unidad(es)</td>
                            <td >
                                <button class="header-action-btn-chat wapisimo" data-id="${order.id}">
                                    <span class="material-symbols-outlined">chat</span>
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
        
}

function loadProducts(){
    fetch(`/dashboard/getMyProducts`)
        .then(response => response.json())
        .then(data => {
            if(data.success === true){
                const productsTableBody = $('#products-table-body');
                productsTableBody.empty(); // Limpiar la tabla antes de agregar nuevos productos
                data.products.forEach(product => {
                    const productRow = `
                        <tr>
                            <td><img src="/assets/img/products/${product.image}" class="product-image" alt=""> ${product.name}</td>
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
    fetch(`/dashboard/getMyPurchases`)
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if(data.success === true){
                const purchasesdiv = $('#purchases-list');
                purchasesdiv.empty(); // Limpiar la tabla antes de agregar nuevos productos
                data.purchases.forEach(purchase => {

                    var descuento = (purchase.porcentaje != null) ? `<p>Precio Total con Descuento: <strong>$${purchase.price-(purchase.price*(purchase.porcentaje/100))}</strong></p>`: "";
                    const purchaseRow = `
                <div class="purchases-list-item">
                    <div class="purchase-item-image">
                        <img src="/assets/img/products/${purchase.image}" alt="${purchase.name}" />
                    </div>
                    <div class="purchase-item-details">
                        <h3>${purchase.name}</h3>
                        <p>Cantidad: ${purchase.cantidad} Unds</p>
                        <p>Precio: $${purchase.price}</p>
                        ${descuento}
                        <p>Fecha de compra: ${purchase.creado_en}</p>
                        <p>Estado: <span class="status ${purchase.status}">${purchase.estado.charAt(0).toUpperCase() + purchase.estado.slice(1)}</span></p>
                        <div class="purchase-item-actions">
                            <button class="purchase-action-btn" id="view-details-btn">
                                <span class="material-symbols-outlined"></span>
                                <span>Ver Detalles</span>
                            </button>
                            <button class="purchase-action-btn-secondary wapisimo" data-id="${purchase.compraid}">
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

function loadDataMain(){
    fetch('/dashboard/getMaindata')
        .then(response => response.json())
        .then(data => {
            $("#compras").text(data.data.compras_mes);
            $("#ventas").text(data.data.ventas_mes);
            $("#ganado").text(data.data.dinero_ganado + "$");
            const recientes = $("#ventas-recientes-body");
            recientes.empty();

            $.each(data.data.ventas_recientes, function (i, v) {
                recientes.append(`
                    <tr>
                        <td>${v.producto}</td>
                        <td>${v.comprador}</td>
                    </tr>
                `);
            });

            const top = $("#products2-table-body");
            top.empty();

            $.each(data.data.top_compradores, function (i, c) {
                top.append(`
                    <tr>
                        <td>
                            <div class="buyer-info">
                                <strong>${c.name}</strong><br>
                                <small>${c.email}</small>
                            </div>
                        </td>
                        <td>${c.cantidad} compras</td>
                        <td>
                            <button onclick="aplicarDescuento(${c.id},'${c.name}','${c.email}')" class="header-action-btn-table">
                                <span class="material-symbols-outlined">percent</span>
                            </button>
                        </td>
                    </tr>
                `);
            });
            
        })

    fetch('/dashboard/getProductosVendidos')
        .then(res => res.json())
        .then(data => {
            const labels = data.map(item => item.name);
            const values = data.map(item => item.total_vendidos);

            new Chart(document.getElementById('productosMasVendidos'), {
                type: 'pie',
                data: {
                    labels: labels,
                    datasets: [{
                        data: values,
                        backgroundColor: ['#03d26f','#014651','#cef431','#161514','#f1f1f1']
                    }]
                }
            });
        });

}

function aplicarDescuento(userId, userName, userE) {

    Swal.fire({
        title: `Aplicar descuento a ${userName}`,
        html: `
            <div style="display:flex; flex-direction:column; gap:12px; font-family: 'Roboto';">

                <label style="text-align:left">Porcentaje de descuento (%)</label>
                <input id="swal-valor" type="number" class="swal2-input" placeholder="Ej: 10">

                <label style="text-align:left">Comentario (opcional)</label>
                <textarea id="swal-nota" class="swal2-textarea" placeholder="Motivo del descuento..."></textarea>
            </div>
        `,
        width: 420,
        confirmButtonText: "Aplicar descuento",
        cancelButtonText: "Cancelar",
        showCancelButton: true,
        focusConfirm: false,
        preConfirm: () => {

            const valor = parseInt($("#swal-valor").val());
            const nota  = $("#swal-nota").val();

            if (isNaN(valor) || valor <= 0 || valor > 100) {
                Swal.showValidationMessage("El descuento debe ser entre 1% y 100%");
                return false;
            }

            return { valor, nota };
        }
    }).then(res => {

        if (res.isConfirmed) {
            const data = new FormData();
            data.append("userId", userId);
            data.append("useremail", userE);
            data.append("porcentaje", res.value.valor);
            data.append("nota", res.value.nota);
            fetch('/dashboard/applydiscountuser',{
                method: "POST",
                body: data
            })
            .then(r => r.json())
            .then(data => {
                if(data.success){
                    Swal.fire(
                    "Descuento aplicado",
                    `Se aplicó un descuento del ${res.value.valor}%`,
                    "success"
                );
                }else{
                    Swal.fire(
                        "Descuento Fallido",
                        `No se aplicó un descuento`,
                        "error"
                    );
                }


            })
        }
    });
}

