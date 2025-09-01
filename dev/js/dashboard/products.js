export function initProducts(){
    $('#open-add-product-modal').on('click', function() {
        $("#modal-product-title").text("Agregar Producto");
        $("#add-product-btn-text").text("Agregar Producto");
        $('.modal-product').css('display', 'flex');
    });

    $(".modal-product").on("click", function(e) {
        if ($(e.target).is(".modal-product")) {
            $(this).hide();
        }
    });

    $("#edit-product").on("click", function() {
        const productId = $(this).data("id");
        alert("Edit product with ID: " + productId);
        $("#modal-product-title").text("Editar Producto");
        $("#add-product-btn-text").text("Guardar Cambios");
        $('.modal-product').css('display', 'flex');
    });

}