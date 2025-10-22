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
    title: 'Inicio de sesión exitoso',
    text: 'Bienvenido a Mercazone',
    showConfirmButton: false,
    timer: 2000
  }).then(() => {
    Swal.fire({
      icon: 'info',
      title: 'Redirigiendo...',
      text: 'Serás enviado a la página principal.',
      showConfirmButton: false,
      timer: 2000
    });

    setTimeout(() => {
      window.location.href = '/MercaZone/';
    }, 2000);
  });
});
</script>

</body>
</html>