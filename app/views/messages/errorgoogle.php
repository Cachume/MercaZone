<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Mercazone</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<script>
document.addEventListener("DOMContentLoaded", () => {
  Swal.fire({
      icon: 'error',
      title: 'Error al iniciar sesión',
      text: 'Hubo un problema al verificar tu cuenta con Google.',
      showConfirmButton: false,
      timer: 3000
    }).then(() => {
      Swal.fire({
        icon: 'warning',
        title: 'Redirigiendo...',
        text: 'Regresando a la página principal.',
        showConfirmButton: false,
        timer: 3000
      });
      setTimeout(() => {
        window.location.href = '<?= APP_URL ?>';
      }, 2000);
    });
});
</script>
</body>
</html>