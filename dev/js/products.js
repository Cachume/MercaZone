$(document).ready(function() { 
    $('#product-item').on('click', function() {
        var productId = $(this).data('productid');
        $('.modal-universal').css('display', 'flex');
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