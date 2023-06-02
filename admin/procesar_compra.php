<?php include_once(__DIR__."/controllers/sistema.php"); 
      require_once(__DIR__.'/controllers/calzado.php');
      require_once(__DIR__.'/controllers/juguete.php');
      require_once(__DIR__.'/controllers/ropa.php');
      require_once (__DIR__."/controllers/cliente.php");
      require_once (__DIR__."/controllers/usuario.php");
      require_once (__DIR__."/controllers/pedido.php");
      require_once (__DIR__."/controllers/detalle_pedido_calzado.php");
      require_once (__DIR__."/controllers/detalle_pedido_juguete.php");
      require_once (__DIR__."/controllers/detalle_pedido_ropa.php");
      require_once (__DIR__."/controllers/pago.php");
      $sistema->validateRolUsuario('Usuario');?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Carrito - P&P</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/user.css">
</head>
<body>
    <?php include_once('views/menu_usuario.php');  ?>

    <?php 
        $totalCompra = 0;
        $totalCalzado = 0;
        $totalJuguete = 0;
        $totalRopa = 0;
        if (isset($_POST['finalizar_compra'])) {
            date_default_timezone_set('America/Mexico_City');
            $fecha = date('Y-m-d');
            $fechaEntrega = date('Y-m-d', strtotime('+3 days', strtotime($fecha)));
            $idCliente = $cliente->getIdCliente($_SESSION['id_usuario']);
            $direccion = $_POST['direccion_entrega'];
            $pagado = 0;
            $entregado = 0;
            $idPedido = $pedido->newPedido($idCliente, $fecha, $fechaEntrega, $pagado, $entregado, $direccion);
            if ($idPedido) {
                $pedido->alert('success', 'bi bi-check-circle-fill', 'NUEVO PEDIDO', 'El pedido fue agregado correctamente.');
                if (isset($_SESSION['carrito']['calzado'])) {
                    foreach ($_SESSION['carrito']['calzado'] as $idCalzado => $cantidad) {
                        $columnas = $detalle_pedido_calzado->newDPC($idPedido, $idCalzado, $cantidad);
                        $dataCalzado = $calzado->get($idCalzado);
                        $subtotal = $cantidad * $dataCalzado[0]['precio'];
                        $totalCalzado += $subtotal;
                        if($columnas){
                            $detalle_pedido_calzado->alert('success', 'bi bi-check-circle-fill', 'NUEVO DETALLE PEDIDO DE CALZADO', 'El detalle de pedido de calzado fue agregado correctamente.');
                        }else {
                            $detalle_pedido_calzado->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
                        }
                    }
                    unset($_SESSION['carrito']['calzado']);
                }
                if (isset($_SESSION['carrito']['juguete'])) {
                    foreach ($_SESSION['carrito']['juguete'] as $idJuguete => $cantidad) {
                        $columnas = $detalle_pedido_juguete->newDPJ($idPedido, $idJuguete, $cantidad);
                        $dataJuguete = $juguete->get($idJuguete);
                        $subtotal = $cantidad * $dataJuguete[0]['precio'];
                        $totalJuguete += $subtotal;
                        if($columnas){
                            $detalle_pedido_juguete->alert('success', 'bi bi-check-circle-fill', 'NUEVO DETALLE PEDIDO DE JUGUETE', 'El detalle de pedido de juguete fue agregado correctamente.');
                        }else {
                            $detalle_pedido_juguete->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
                        }
                    }
                    unset($_SESSION['carrito']['juguete']);
                }
                if (isset($_SESSION['carrito']['ropa'])) {
                    foreach ($_SESSION['carrito']['ropa'] as $idRopa => $cantidad) {
                        $columnas = $detalle_pedido_ropa->newDPR($idPedido, $idRopa, $cantidad);
                        $dataRopa = $ropa->get($idRopa);
                        $subtotal = $cantidad * $dataRopa[0]['precio'];
                        $totalRopa += $subtotal;
                        if($columnas){
                            $detalle_pedido_ropa->alert('success', 'bi bi-check-circle-fill', 'NUEVO DETALLE PEDIDO DE ROPA', 'El detalle de pedido de ropa fue agregado correctamente.');
                        }else {
                            $detalle_pedido_ropa->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
                        }
                    }
                    unset($_SESSION['carrito']['ropa']);
                }
                $totalCompra = $totalCalzado + $totalRopa + $totalJuguete;
                $dataPago = [
                    'id_pedido' => $idPedido,
                    'id_metodo_pago' => 2, // Debes obtener el ID del método de pago seleccionado
                    'monto' => $totalCompra, // Utiliza el monto enviado desde PayPal
                    'folio' => 'ASDASD123212' // Puedes generar un folio único para el pago
                ];
                $pagos = $pago->new($dataPago);
            }else{
                $pedido->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
            }  
            $pagoRealizado = $pedido->updatePagado($idPedido);
        }
    ?>
    <section style="display: flex; justify-content: center; align-items: center; height: 100vh;">
        <div class="card-container" style="width: 300px; background-color: #fff; border: 1px solid #ccc; border-radius: 4px; padding: 20px;">
            <h4 class="titulo-card centrar-texto">Pedido procesado</h4>
            <div class='product_wrapper' style="margin-bottom: 20px;">
                <?php $_SESSION['pedido'] = $idPedido; ?>
                <div class='name'>Pedido No: <?php echo $idPedido; ?></div>
                <div class='price'>$<?php echo $totalCompra; ?></div>
            </div>
            <form method='post' action="https://www.sandbox.paypal.com/cgi-bin/webscr">
                <!-- PayPal business email to collect payments -->
                <input type='hidden' name='business' value='sb-mkccw15189879@business.example.com'>

                <!-- Details of item that customers will purchase -->
                <input type='hidden' name='idPedido' value='<?php echo $idPedido; ?>'>
                <input type='hidden' name='amount' value='<?php echo $totalCompra; ?>'>
                <input type='hidden' name='currency_code' value="MXN">
                <input type='hidden' name='no_shipping' value='1'>

                <!-- PayPal return, cancel & IPN URLs -->
                <input type='hidden' name='return' value='http://localhost/picco/admin/return.php'>
                <input type='hidden' name='cancel_return' value='http://localhost/picco/admin/cancel.php'>

                <!-- Specify a Pay Now button. -->
                <input type="hidden" name="cmd" value="_xclick">
                <button type='submit' class='pay' style="background-color: #007bff; color: #fff; border: none; padding: 10px 20px; border-radius: 4px; cursor: pointer;">Pay Now</button>
            </form>
        </div>
    </section>


    <?php include_once('views/footer_usuario.php');  ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>