<!DOCTYPE html>
<html>
<head>
  <meta charset="UTF-8">
  <title>Mercazone</title>
  <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
</head>
<body>
<script>
  <?php
    switch ($this->data) {
      case 'terminos':
        echo "
            Swal.fire({
                icon: 'error',
                title: 'Debes aceptar los terminos para verificarte',
                text: 'Debes aceptar que los datos enviados son correctos',
                showConfirmButton: false,
                timer: 2000
              })
              setTimeout(() => {
                window.location.href = '".APP_URL."/dashboard/verificacion';
              }, 2000);
        ";
        break;
      
      default:
        break;
    }
    ?>
</script>
</body>
</html>