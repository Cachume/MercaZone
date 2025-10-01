$(document).ready(function() { 
    $('.product-item').on('click', function() {
        var productId = $(this).data('productid');
        console.log('Product ID:', productId);
        fetch('http://localhost/MercaZone/producto/get_product?producto=' + productId)
            .then(response => response.json())
            .then(data => {
                console.log(data);
                if (data.success) {
                    $('.modal-product-info .product-info-img img').attr('src', "/MercaZone/assets/img/products/"+data.data.image);
                    $('.modal-product-info .product-info-title').text(data.data.name);
                    $('.modal-product-info .product-info-price').text('$' + data.data.price + ' / ' + data.data.price*172 + 'Bs');
                    $('.modal-product-info .product-info-description').text(data.data.description);
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
});