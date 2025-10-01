$(document).ready(function() {
    $(".open-chat").on("click", function(){
        $('.modal-universal').css('display', 'flex');
    });
    
    $('.modal-universal').on('click', function(e) {
            if (e.target === this) {
                $(this).fadeOut();
            }   
        });

});