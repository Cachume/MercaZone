<?php
    date_default_timezone_set('America/Caracas');
    $fecha_reporte = date('d/m/Y h:i A');
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Mercazone | Reportes de Ventas por Categorias</title>
    <style>
        body{
            font-family: Arial, Helvetica, sans-serif;
            display: flex;
            flex-direction: column;
            align-items: center;
        }
    </style>
</head>
<body style="text-align: center;">
    <h1>
        <span style="color:#00b45d">Merca<span style="color:#014651">Zone</span></span>
    </h1>
    <h2>Reporte de ventas por Categorias</h2>
    <div class="datos-vendedor" style="width: 100%; text-align:left;">
        <p>Vendedor: <strong><?=$_SESSION['nombre']." ".$_SESSION['apellidos'] ?></strong></p>
        <p>Cedula de identidad: <strong><?=$_SESSION['type_dni']."-".$_SESSION['cedula'] ?></strong></p>
        <p>Fecha del reporte: <strong><?= $fecha_reporte?></strong></p>
    </div>

    <?php foreach ($this->data as $categoria => $productos): ?>
    <h3 style="color:#014651; margin-top:30px;">
        Categoría: <?= $categoria ?>
    </h3>
    <table style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif; margin-top: 20px; background-color: #e8f1f3; color: #161514;">
      <thead>
        <tr style="background-color: #014651; color: #f1f1f1;">
          <th style="border: 1px solid #03d26f; padding: 10px;">Producto</th>
          <th style="border: 1px solid #03d26f; padding: 10px;">Vendidos</th>
          <th style="border: 1px solid #03d26f; padding: 10px;">Ingresos</th>
        </tr>
      </thead>
      <tbody>
         <?php foreach ($productos as $fila): ?>
            <tr>
                <td style="padding:10px; border:1px solid #ccc;"><?= $fila['producto'] ?></td>
                <td style="padding:10px; border:1px solid #ccc;"><?= $fila['vendidos'] ?></td>
                <td style="padding:10px; border:1px solid #ccc;">$<?= number_format($fila['ingresos'], 2) ?></td>
            </tr>
            <?php endforeach; ?>
        
      </tbody>
    </table>
    <?php endforeach;?>
    <p><strong>Nota:</strong> Los numeros aqui presentes de los productos son un aproximado de los usuarios que han dado en comprar a tus productos.</p>
</body>
</html>