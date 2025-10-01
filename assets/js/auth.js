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
    if (!showingCodeField) {
      e.preventDefault();

      const email = $('#email').val().trim();
      if (!email) {
        Swal.fire('Error', 'Por favor, ingresa tu correo.', 'error');
        return;
      }

      $('#login-btn').prop('disabled', true).text('Enviando código...');

      $.ajax({
        url: 'http://localhost/MercaZone/auth/sendCode',
        type: 'POST',
        data: { email: email },
        success: function (response) {
          const res = typeof response === 'string' ? JSON.parse(response) : response;

          if (res.success) {
            Swal.fire('¡Código enviado!', 'Revisa tu correo para continuar.', 'success');
            iniciarTemporizadorBoton();

            $('#code-group').slideDown();
            $('#codigo').prop('required', true);
            $('#forgot-link').hide();
            $('#login-btn').text('Verificar código');
            showingCodeField = true;
            $('#login-btn').prop('disabled', false).text('Verificar código');
            $('#resendbtn').show();
          } else {
            Swal.fire('Error', res.message || 'No se pudo enviar el código.', 'error');
            $('#login-btn').prop('disabled', false).text('Iniciar sesión');
          }
        },
        error: function () {
          Swal.fire('Error', 'No se pudo conectar con el servidor.', 'error');
          $('#login-btn').prop('disabled', false).text('Iniciar sesión');
        }
      });
    }
  });

  $('#resendbtn').on('click', function () {
  const email = $('#email').val().trim();

  if (!email) {
    Swal.fire('Error', 'Por favor, ingresa tu correo.', 'error');
    return;
  }

  const btn = $(this);
  btn.prop('disabled', true).text('Reenviando...');

  $.ajax({
    url: 'http://localhost/MercaZone/auth/sendCode',
    type: 'POST',
    data: { email: email },
    success: function (response) {
      const res = typeof response === 'string' ? JSON.parse(response) : response;

      if (res.success) {
        Swal.fire('¡Código reenviado!', 'Revisa nuevamente tu correo.', 'success');
        iniciarTemporizadorBoton();
      } else {
        Swal.fire('Error', res.message || 'No se pudo reenviar el código.', 'error');
        btn.prop('disabled', false).text('Reenviar código');
      }
    },
    error: function () {
      Swal.fire('Error', 'No se pudo conectar con el servidor.', 'error');
      btn.prop('disabled', false).text('Reenviar código');
    }
  });
});

  function iniciarTemporizadorBoton() {
    let segundos = 60;
    $('#resendbtn').prop('disabled', true).text(`Reintenta en ${segundos}s`);

    const interval = setInterval(() => {
      segundos--;
      $('#resendbtn').text(`Reintenta en ${segundos}s`);

      if (segundos <= 0) {
        clearInterval(interval);
        $('#resendbtn').prop('disabled', false).text('Reenviar Codigo');
      }
    }, 1000);
  }
});

$(document).ready(function () {
  let showingCodeFieldReg = false;

  $('#auth-register').on('submit', function (e) {
    const email = $('#emailr').val().trim();
    const cedula = $('#emailc').val().trim();

    if (!showingCodeFieldReg) {
      e.preventDefault();

      if (!email || !cedula) {
        Swal.fire('Error', 'Debes ingresar tu cédula y correo.', 'error');
        return;
      }

      $('button[name="registro"]').prop('disabled', true).text('Enviando código...');
      $.ajax({
        url: 'http://localhost/MercaZone/auth/sendCoder',
        type: 'POST',
        data: {
          email: email,
          cedula: cedula
        },
        success: function (response) {
          const res = typeof response === 'string' ? JSON.parse(response) : response;
          if (res.success) {
            Swal.fire('¡Código enviado!', 'Revisa tu correo para continuar.', 'success');
            $('#code-group').slideDown();
            $('#codigo2').prop('required', true);
            $('#codigo2').show()
            $('#resend-register-btn').show();
            $('button[name="registro"]').text('Verificar código');
            showingCodeFieldReg = true;
            iniciarTemporizador($('#resend-register-btn'));
          } else {
            Swal.fire('Error', res.message || 'No se pudo enviar el código.', 'error');
          }
        },
        error: function () {
          console.log('Error en la solicitud AJAX');
          Swal.fire('Error', 'No se pudo conectar con el servidor.', 'error');
        },
        complete: function () {
          $('button[name="registro"]').prop('disabled', false);
        }
      });
    }
  });

  $('#resend-register-btn').on('click', function () {
    const email = $('#emailr').val().trim();
    const cedula = $('#emailc').val().trim();

    if (!email || !cedula) {
      Swal.fire('Error', 'Debes ingresar el correo y cédula.', 'error');
      return;
    }

    const btn = $(this);
    btn.prop('disabled', true).text('Reenviando...');

    $.ajax({
      url: 'http://localhost/MercaZone/auth/sendCoder',
      type: 'POST',
      data: {
        email: email,
        cedula: cedula
      },
      success: function (response) {
        const res = typeof response === 'string' ? JSON.parse(response) : response;

        if (res.success) {
          Swal.fire('Código reenviado', 'Revisa tu correo nuevamente.', 'success');
          iniciarTemporizador(btn);
        } else {
          Swal.fire('Error', res.message || 'No se pudo reenviar el código.', 'error');
          btn.prop('disabled', false).text('Reenviar código');
        }
      },
      error: function () {
        Swal.fire('Error', 'No se pudo conectar con el servidor.', 'error');
        btn.prop('disabled', false).text('Reenviar código');
      }
    });
  });

  function iniciarTemporizador(btn) {
    let segundos = 30;
    btn.text(`Espera ${segundos}s`);
    const intervalo = setInterval(() => {
      segundos--;
      btn.text(`Espera ${segundos}s`);
      if (segundos <= 0) {
        clearInterval(intervalo);
        btn.prop('disabled', false).text('Reenviar código');
      }
    }, 1000);
  }
});