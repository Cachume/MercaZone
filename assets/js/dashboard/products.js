$('#open-add-product-modal').on('click', function() {
    $("#modal-product-title").text("Agregar Producto");
    $("#add-product-btn-text").text("Agregar Producto");
    $('.modal-product').css('display', 'flex');
    $('#add-product-form')[0].reset();
    $("#product-image-preview").attr("src", "");
});

$(document).on("click", ".header-action-btn-edit", function() {
    const productId = $(this).data("id");
    $("#modal-product-title").text("Editar Producto");
    $("#add-product-btn-text").text("Guardar Cambios");
    $('.modal-product').css('display', 'flex');
    fetch('http://192.168.0.107:80/MercaZone/index.php?u=dashboard&m=getmyproduct&id=' + productId)
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if (data.success) {
                const product = data.products[0];
                $("#product-id").val(product.id);
                $("#product-name").val(product.name);
                $("#product-category").val(product.category);
                $("#product-full-description").val(product.description);
                $("#product-description").val(product.short_description);
                $("#product-price").val(product.price);
                $("#product-stock").val(product.stock);
                $("#product-image-preview").attr("src", "../img/"+product.image);
            }
        });
});

$(document).on("click", ".header-action-btn-delete", function() {
    const productId = $(this).data("id");
    alert("Delete product with ID: " + productId);
});

$(".modal-product").on("click", function(e) {
    if ($(e.target).is(".modal-product")) {
        $(this).hide();
    }
});