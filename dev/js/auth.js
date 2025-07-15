btnlogin = document.getElementById("login");
btnregister = document.getElementById("register");
formlogin = document.getElementById("auth-login");
formregister = document.getElementById("auth-register");
textform = document.getElementById("textform")

var estadoform = 'login';

btnlogin.addEventListener('click',function(){
    
    if(estadoform != "login"){
        formregister.classList.add("hidden")
        formlogin.classList.remove("hidden")
        estadoform = "login"
        btnregister.classList.remove("selected");
        btnlogin.classList.add("selected");
        textform.innerHTML = "Inicia sesión para continuar"
    }
})

btnregister.addEventListener('click',function(){
    
    if(estadoform != "register"){
        formlogin.classList.add("hidden")
        formregister.classList.remove("hidden")
        estadoform = "register"
        btnregister.classList.add("selected");
        btnlogin.classList.remove("selected");
        textform.innerHTML = "Completa los campos para crear una cuenta nueva"
    }
})


$(document).ready(function () {
    let showingCodeField = false;

    $('#auth-login').on('submit', function (e) {
      const email = $('#email').val().trim();

      if (!showingCodeField) {
        e.preventDefault();

        if (email === '') {
          alert('Por favor ingresa tu correo electrónico.');
          return;
        }

        // Petición AJAX para enviar código
        $.ajax({
          url: '/auth/send-code',
          method: 'POST',
          data: { email: email },
          success: function (response) {
            if (response.success) {
              alert('Código enviado a tu correo.');
              $('#code-group').slideDown();
              $('#codigo').prop('required', true);
              $('#forgot-link').hide();
              $('#login-btn').text('Verificar código');
              showingCodeField = true;
            } else {
              alert(response.message || 'Error al enviar el código.');
            }
          },
          error: function () {
            alert('Error del servidor al enviar el código.');
          }
        });

        return;
      }

      // Ya se mostró el campo, ahora permite el envío del formulario
    });
  });