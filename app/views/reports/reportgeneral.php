<?php
    $ventas  = $this->data["ventas"];
    $compras = $this->data["compras"];
    $general = $this->data["general"];
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
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
</head>
<body style="text-align: center;">
    <h1>
        <span style="color:#00b45d">Merca<span style="color:#014651">Zone</span></span>
    </h1>
    <h2>Reporte General</h2>
    <div class="datos-vendedor" style="width: 100%; text-align:left;">
        <p>Vendedor: <strong><?=$_SESSION['nombre']." ".$_SESSION['apellidos'] ?></strong></p>
        <p>Cedula de identidad: <strong><?=$_SESSION['type_dni']."-".$_SESSION['cedula'] ?></strong></p>
        <p>Fecha del reporte: <strong><?= $fecha_reporte?></strong></p>
    </div>

    <div class="section">
    <h2>Ventas por Categoría</h2>
    <canvas id="graficaVentas"></canvas>

    <script>
        const ventasLabels = <?= json_encode(array_column($ventas, "categoria")); ?>;
        const ventasValues = <?= json_encode(array_column($ventas, "total_vendido")); ?>;

        new Chart(document.getElementById("graficaVentas"), {
            type: 'pie',
            data: {
                labels: ventasLabels,
                datasets: [{
                    data: ventasValues,
                    backgroundColor: ['#03d26f', '#014651', '#cef431', '#161514', '#f1f1f1']
                }]
            }
        });
    </script>

    <div class="table-container">
        <table style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif; margin-top: 20px; background-color: #e8f1f3; color: #161514;">
            <tr style="background-color: #014651; color: #f1f1f1;">
                <th style="border: 1px solid #03d26f; padding: 10px;">Categoría</th>
                <th style="border: 1px solid #03d26f; padding: 10px;">Total Vendido (USD)</th>
            </tr>
            <?php foreach ($ventas as $v): ?>
            <tr>
                <td style="padding:10px; border:1px solid #ccc;"><?= $v["categoria"] ?></td>
                <td style="padding:10px; border:1px solid #ccc;"><?= number_format($v["total_vendido"], 2) ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>


<div class="section">
    <h2>Compras por Categoría</h2>
    <canvas id="graficaCompras"></canvas>

    <script>
        const comprasLabels = <?= json_encode(array_column($compras, "categoria")); ?>;
        const comprasValues = <?= json_encode(array_column($compras, "total_compras")); ?>;

        new Chart(document.getElementById("graficaCompras"), {
            type: 'pie',
            data: {
                labels: comprasLabels,
                datasets: [{
                    data: comprasValues,
                    backgroundColor: ['#014651', '#03d26f', '#cef431', '#161514', '#f1f1f1']
                }]
            }
        });
    </script>

    <div class="table-container">
        <table style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif; margin-top: 20px; background-color: #e8f1f3; color: #161514;">
            <tr style="background-color: #014651; color: #f1f1f1;">
                <th style="border: 1px solid #03d26f; padding: 10px;">Categoría</th>
                <th style="border: 1px solid #03d26f; padding: 10px;">Total Compras</th>
            </tr>
            <?php foreach ($compras as $c): ?>
            <tr>
                <td style="padding:10px; border:1px solid #ccc;"><?= $c["categoria"] ?></td>
                <td style="padding:10px; border:1px solid #ccc;"><?= $c["total_compras"] ?></td>
            </tr>
            <?php endforeach; ?>
        </table>
    </div>
</div>


<div class="section">
    <h2>Reporte General (Ventas + Compras)</h2>
    <canvas id="graficaGeneral"></canvas>

    <script>
        const generalLabels = <?= json_encode(array_column($general, "categoria")); ?>;

        const generalValues = [
            <?php foreach ($general as $g): ?>
                <?= $g["total_vendido"] + $g["total_compras"] ?>,
            <?php endforeach; ?>
        ];

        new Chart(document.getElementById("graficaGeneral"), {
            type: 'pie',
            data: {
                labels: generalLabels,
                datasets: [{
                    data: generalValues,
                    backgroundColor: ['#cef431', '#03d26f', '#014651', '#161514', '#f1f1f1']
                }]
            }
        });
    </script>

    <div class="table-container">
        <table style="width: 100%; border-collapse: collapse; font-family: Arial, sans-serif; margin-top: 20px; background-color: #e8f1f3; color: #161514;">
            <tr style="background-color: #014651; color: #f1f1f1;">
                <th style="border: 1px solid #03d26f; padding: 10px;">Categoría</th>
                <th style="border: 1px solid #03d26f; padding: 10px;">Ventas (USD)</th>
                <th style="border: 1px solid #03d26f; padding: 10px;">Compras</th>
            </tr>

            <?php foreach ($general as $g): ?>
            <tr>
                <td style="padding:10px; border:1px solid #ccc;"><?= $g["categoria"] ?></td>
                <td style="padding:10px; border:1px solid #ccc;"><?= number_format($g["total_vendido"], 2) ?></td>
                <td style="padding:10px; border:1px solid #ccc;"><?= $g["total_compras"] ?></td>
            </tr>
            <?php endforeach; ?>

        </table>
    </div>
</div>

    <p><strong>Nota:</strong> Los numeros aqui presentes de los productos son un aproximado de los usuarios que han dado en comprar a tus productos.</p>
</body>
</html>