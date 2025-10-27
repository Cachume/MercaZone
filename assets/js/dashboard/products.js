$('#open-add-product-modal').on('click', function() {
    $("#modal-product-title").text("Agregar Producto");
    $("#add-product-btn-text").text("Agregar Producto");
    $('.modal-product').css('display', 'flex');
    $('#add-product-form')[0].reset();
    $("#product-image-preview").attr("src", "");
});

const baseURL = `${window.location.protocol}//${window.location.hostname}/`;

$(document).on("click", ".header-action-btn-edit", function() {
    const productId = $(this).data("id");
    $("#modal-product-title").text("Editar Producto");
    $("#add-product-btn-text").text("Guardar Cambios");
    $('.modal-product').css('display', 'flex');
    fetch(`${baseURL}dashboard/getMyProduct&id_product=` + productId)
        .then(response => response.json())
        .then(data => {
            console.log(data);
            if (data.success) {
                const product = data.product;
                $("#product-id").val(product.id);
                $("#product-name").val(product.name);
                $("#product-category").val(product.category);
                $("#product-full-description").val(product.description);
                $("#product-description").val(product.short_description);
                $("#product-price").val(product.price);
                $("#product-stock").val(product.stock);
                $("#product-image-preview").attr("src", "/assets/img/products/"+product.image);
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

    $('#add-product-btn').on('click', function() {
        let form = $('#add-product-form')[0];
        let formData = new FormData(form);
        console.log(...formData);
        fetch(`${baseURL}dashboard/addProduct`, {
            method: 'POST',
            body: formData
        })
        .then(response => response.json())
        .then(data => {
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Se ha agregado el producto',
                    text: data.message,
                    timer: 2000,
                    showConfirmButton: false,
                    timerProgressBar: true,
                    willClose: () => {
                        loadProducts();
                    } 
                })
                $('.modal-product').hide();
                $('#add-product-form')[0].reset();
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error al agregar el producto',
                    text: data.message,
                    timer: 2000,
                    showConfirmButton: false,
                    timerProgressBar: true,
                })
            }
            console.log(data);
        })
        .catch(error => {
            console.error('Error:', error);
        }); 
    });

    $('#product-image').on('change', function() {
        const file = this.files[0];
        if (file) {
            const reader = new FileReader();
            reader.onload = function(e) {
                $("#product-image-preview").attr("src", e.target.result);
            };
            reader.readAsDataURL(file);
        }
    });
