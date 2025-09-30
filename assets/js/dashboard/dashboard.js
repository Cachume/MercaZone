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
            break;
        case "link-settings":
            viewName = "Configuraciones";
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