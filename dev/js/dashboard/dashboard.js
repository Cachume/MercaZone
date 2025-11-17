$(document).ready(function() {
    // $(".dashboard-main").hide();
    // $(".dashboard-verification").show();
    // ChangeNameDashboard("link-verification");

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

    $("#update") .on("click", function(){
        loadDataMain();
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
            break;
        case "link-settings":
            viewName = "Configuraciones";
            break;
        case "link-chat":
            viewName = "Chat";
            break;
        case "link-verification":
            viewName = "Verificación";
            break;
        default:
            viewName = "Dashboard";
            break;
    }
    $("#dashboard-title").text(viewName);
}

function loadProducts(){
    fetch('http://localhost/MercaZone/index.php?u=dashboard&m=getmyproducts')
        .then(response => response.json())
        .then(data => {
            if(data.success === true){
                const productsTableBody = $('#products-table-body');
                productsTableBody.empty(); // Limpiar la tabla antes de agregar nuevos productos
                data.products.forEach(product => {
                    const productRow = `
                        <tr>
                            <td><img src="../img/${product.image}" class="product-image" alt=""> ${product.name}</td>
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
            }).then(() => {location.reload();});
        });
}

function loadDataMain(){
    fetch('http://localhost/dashboard/getMaindata')
        .then(response => response.json())
        .then(data => {
            console.log(data)
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

            const top = $("#products-table-body");
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
                            <button onclick="aplicarDescuento(${c.id},'${c.name}')" class="header-action-btn-table">
                                <span class="material-symbols-outlined">percent</span>
                            </button>
                        </td>
                    </tr>
                `);
            });
            
        })

}

function aplicarDescuento(userId, userName) {

    Swal.fire({
        title: `Aplicar descuento a ${userName}`,
        html: `
            <div style="display:flex; flex-direction:column; gap:12px;">

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
            data.append("porcentaje", res.value.valor);
            data.append("nota", res.value.nota);

        }
    });
}

