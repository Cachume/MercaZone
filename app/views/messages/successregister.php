<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Bienvenido a Mercazone</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>

<script>
document.addEventListener("DOMContentLoaded", () => {
  Swal.fire({
    icon: 'success',
    title: 'Activación Exitosa',
    text: 'Se ha enviado a tu correo electronico tus datos de inicio de sesión',
    showConfirmButton: false,
    timer: 2000
  }).then(() => {
    Swal.fire({
      icon: 'info',
      title: 'Redirigiendo...',
      text: 'Serás enviado a la página de inicio de sesión.',
      showConfirmButton: false,
      timer: 2000
    });

    setTimeout(() => {
      window.location.href = '<?= APP_URL ?>/autenticarse';
    }, 2000);
  });
});
</script>

</body>
</html>