$(document).ready(function() {
    //  $(".dashboard-main").hide();
    //  $(".dashboard-products").show();
    //  ChangeNameDashboard("link-products");

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
        default:
            viewName = "Dashboard";
            break;
    }
    $("#dashboard-title").text(viewName);
}

function loadProducts(){
    fetch('http://192.168.0.111:80/MercaZone/index.php?u=dashboard&m=getmyproducts')
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
                                <button class="header-action-btn-edit" id="edit-product" data-id="${product.id}">
                                    <span  class="material-symbols-outlined">edit</span>
                                </button>
                                <button class="header-action-btn-delete" id="delete-product" data-id="${product.id}">
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