$(document).ready(function() {
    const baseURL = `${window.location.protocol}//${window.location.hostname}/MercaZone/`;
    $('.product-item').on('click', function() {
        var productId = $(this).data('productid');
        console.log('Product ID:', productId);
        fetch(`/producto/get_product?producto=` + productId)
            .then(response => response.json())
            .then(data => {
                console.log(data);
                if (data.success) {
                    $('.modal-product-info .product-info-img img').attr('src', "/assets/img/products/"+data.data.image);
                    $('.modal-product-info .product-info-title').text(data.data.name);
                    $('.modal-product-info .product-info-price').text('$' + data.data.price + ' / ' + data.data.price*172 + 'Bs');
                    $('.modal-product-info .product-info-description').text(data.data.description);
                    $('.modal-product-info .product-info-nameuser').text(data.data.nombre+' '+data.data.apellidos);
                    $('.modal-product-info .product-info-sold').text('Vendidos: ' + data.data.sales);
                    $('.quantity-select').empty();
                    for (let i = 1; i <= data.data.stock; i++) {
                        let option = new Option(i, i);
                        $('.quantity-select').append(option);
                    }
                    $('.modal-universal').css('display', 'flex');
                } else {
                    // Handle product not found
                    alert(data.message);
                }
            });
        
    });
    
    $('.modal-universal').on('click', function(e) {
        if (e.target === this) {
            $(this).fadeOut();
        }   
    });

    $('#modal-close').on('click', function() {
        $('.modal-universal').fadeOut();
    });

    $('#buy-product').on('click', function() {
        var productId = $('.product-item').data('productid');
        var quantity = $('#quantity').val();

        fetch(`/producto/buyProduct`,
        {
            method: 'POST',
            headers: {
                'Content-Type': 'application/json'
            },
            body: JSON.stringify({ id: productId, cantidad: quantity })
        })
        .then(response => response.json())
        .then(data => {
            console.log(data)
            if (data.success) {
                Swal.fire({
                    icon: 'success',
                    title: 'Compra exitosa',
                    text: data.message,
                    timer: 2000,
                    showConfirmButton: false,
                    timerProgressBar: true,
                    willClose: () => {
                    window.location.href = '/dashboard/miscompras';
                    } 
                }).then(() => {
                    $('.modal-universal').fadeOut();
                });
            } else {
                Swal.fire({
                    icon: 'error',
                    title: 'Error en la compra',
                    text: data.message,
                });
                //alert(data.message);
            }
        });
    });

});