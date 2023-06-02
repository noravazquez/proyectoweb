<?php include_once(__DIR__."/controllers/sistema.php"); 
      $sistema->validateRolUsuario('Usuario');
      include_once(__DIR__."/controllers/pedido.php"); 
      include_once(__DIR__."/controllers/cliente.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Comentarios</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/index_style.css">
</head>
<body>
    <?php include_once('views/menu_usuario.php');  ?>

        <br>
        <h2 style="text-align: center;">Mis pedidos</h2>
        <div class="separator"></div>
        <br>

        <table style="margin: 0 auto; width: 90%; border-collapse: collapse; text-align: center;">
            <tr>
                <th style="padding: 10px; background-color: #f2f2f2;">Fecha Pedido</th>
                <th style="padding: 10px; background-color: #f2f2f2;">Pagado</th>
                <th style="padding: 10px; background-color: #f2f2f2;">Entregado</th>
                <th style="padding: 10px; background-color: #f2f2f2;">Fecha Entrega</th>
                <th style="padding: 10px; background-color: #f2f2f2;">Dirección Entrega</th>
                <th style="padding: 10px; background-color: #f2f2f2;">Monto</th>
                <th style="padding: 10px; background-color: #f2f2f2;">Juguete</th>
                <th style="padding: 10px; background-color: #f2f2f2;">Cantidad Juguete</th>
                <th style="padding: 10px; background-color: #f2f2f2;">Ropa</th>
                <th style="padding: 10px; background-color: #f2f2f2;">Cantidad Ropa</th>
                <th style="padding: 10px; background-color: #f2f2f2;">Calzado</th>
                <th style="padding: 10px; background-color: #f2f2f2;">Cantidad Calzado</th>
            </tr>

            <?php
            $idCliente = $cliente->getIdCliente($_SESSION['id_usuario']);
            $pedidos = $pedido->getPedidos($idCliente); // Obtener los datos de los pedidos

            if (count($pedidos) > 0) {
                foreach ($pedidos as $pedido) {
                    echo '<tr>';
                    echo '<td style="padding: 10px;">'.$pedido['fecha_pedido'].'</td>';
                    echo '<td style="padding: 10px;">'.($pedido['pagado'] == 1 ? 'Sí' : 'No').'</td>';
                    echo '<td style="padding: 10px;">'.($pedido['entregado'] == 1 ? 'Sí' : 'No').'</td>';
                    echo '<td style="padding: 10px;">'.$pedido['fecha_entrega'].'</td>';
                    echo '<td style="padding: 10px;">'.$pedido['direccion_entrega'].'</td>';
                    echo '<td style="padding: 10px;">'.$pedido['monto'].'</td>';
                    echo '<td style="padding: 10px;">'.$pedido['juguete'].'</td>';
                    echo '<td style="padding: 10px;">'.$pedido['cantidad_juguete'].'</td>';
                    echo '<td style="padding: 10px;">'.$pedido['ropa'].'</td>';
                    echo '<td style="padding: 10px;">'.$pedido['cantidad_ropa'].'</td>';
                    echo '<td style="padding: 10px;">'.$pedido['calzado'].'</td>';
                    echo '<td style="padding: 10px;">'.$pedido['cantidad_calzado'].'</td>';
                    echo '</tr>';
                }
            } else {
                echo '<tr><td colspan="13" style="padding: 10px;">No se encontraron pedidos.</td></tr>';
            }
            ?>

        </table>

        <br>
        <div class="separator"></div>
        <br>

    </div>

    <?php include_once('views/footer_usuario.php');  ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>