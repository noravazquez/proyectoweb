<?php include_once(__DIR__."/controllers/sistema.php"); 
      require_once(__DIR__.'/controllers/calzado.php');
      require_once(__DIR__.'/controllers/juguete.php');
      require_once(__DIR__.'/controllers/ropa.php');
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

    <br>
    <h2 style="text-align: center;">Carrito de compras</h2>
    <div class="separator"></div>
    <br>

    <h2 style="text-align: center;">Calzado</h2>
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio unitario</th>
                <th>Subtotal</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $totalCompra = 0;
            // Manejar las acciones
            if (isset($_POST['actionCalzado'])) {
                $actionCalzado = $_POST['actionCalzado'];
                $idCalzado = $_POST['idCalzado'];

                if ($actionCalzado === 'addCalzado') {
                    // Incrementar la cantidad del producto en el carrito
                    $_SESSION['carrito']['calzado'][$idCalzado]++;
                } elseif ($actionCalzado === 'removeCalzado') {
                    // Eliminar el producto del carrito
                    unset($_SESSION['carrito']['calzado'][$idCalzado]);
                }
            }

            if (isset($_POST['actionJuguete'])) {
                $actionJuguete = $_POST['actionJuguete'];
                $idJuguete = $_POST['idJuguete'];

                if ($actionJuguete === 'addJuguete') {
                    // Incrementar la cantidad del producto en el carrito
                    $_SESSION['carrito']['juguete'][$idJuguete]++;
                } elseif ($actionJuguete === 'removeJuguete') {
                    // Eliminar el producto del carrito
                    unset($_SESSION['carrito']['juguete'][$idJuguete]);
                }
            }

            if (isset($_POST['actionJuguete'])) {
                $actionJuguete = $_POST['actionJuguete'];
                $idJuguete = $_POST['idJuguete'];

                if ($actionJuguete === 'addJuguete') {
                    // Incrementar la cantidad del producto en el carrito
                    $_SESSION['carrito']['juguete'][$idJuguete]++;
                } elseif ($actionJuguete === 'removeJuguete') {
                    // Eliminar el producto del carrito
                    unset($_SESSION['carrito']['juguete'][$idJuguete]);
                }
            }
            
            if (isset($_POST['actionRopa'])) {
                $actionRopa = $_POST['actionRopa'];
                $idRopa = $_POST['idRopa'];

                if ($actionRopa === 'addRopa') {
                    // Incrementar la cantidad del producto en el carrito
                    $_SESSION['carrito']['ropa'][$idRopa]++;
                } elseif ($actionRopa === 'removeRopa') {
                    // Eliminar el producto del carrito
                    unset($_SESSION['carrito']['ropa'][$idRopa]);
                }
            }

            $totalCalzado = 0;
            if (isset($_SESSION['carrito']['calzado'])) {
                foreach ($_SESSION['carrito']['calzado'] as $idCalzado => $cantidadCalzado) {
                    $dataCalzado = $calzado->get($idCalzado);
                    $subtotal = $cantidadCalzado * $dataCalzado[0]['precio'];
                    $totalCalzado += $subtotal;
                    ?>
                    <tr>
                        <td><?php echo $dataCalzado[0]['calzado']; ?></td>
                        <td><?php echo $cantidadCalzado; ?></td>
                        <td>$ <?php echo $dataCalzado[0]['precio']; ?></td>
                        <td>$ <?php echo $subtotal; ?></td>
                        <td>
                            <form action="cart.php" method="POST">
                                <input type="hidden" name="idCalzado" value="<?php echo $idCalzado; ?>">
                                <input type="hidden" name="actionCalzado" value="addCalzado">
                                <input type="submit" value="Agregar más" style="background-color: #4CAF50; color: white; padding: 8px 16px; border: none; cursor: pointer;">
                            </form>
                            <br>
                            <form action="cart.php" method="POST">
                                <input type="hidden" name="idCalzado" value="<?php echo $idCalzado; ?>">
                                <input type="hidden" name="actionCalzado" value="removeCalzado">
                                <input type="submit" value="Eliminar" style="background-color: #f44336; color: white; padding: 8px 16px; border: none; cursor: pointer;">
                            </form>
                        </td>
                    </tr>
                    <?php
                }
            }
            ?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3"></td>
                <td>Total:</td>
                <td>$ <?php echo $totalCalzado; ?></td>
            </tr>
        </tfoot>
    </table>

    <!-- Tabla de Ropa -->
    <h2 style="text-align: center;">Ropa</h2>
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio unitario</th>
                <th>Subtotal</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php $totalRopa = 0;
            if (isset($_SESSION['carrito']['ropa'])) {
                foreach ($_SESSION['carrito']['ropa'] as $idRopa => $cantidadRopa) {
                    $dataRopa = $ropa->get($idRopa);
                    $subtotal = $cantidadRopa * $dataRopa[0]['precio'];
                    $totalRopa += $subtotal;
                    ?>
                    <tr>
                        <td><?php echo $dataRopa[0]['ropa']; ?></td>
                        <td><?php echo $cantidadRopa; ?></td>
                        <td>$ <?php echo $dataRopa[0]['precio']; ?></td>
                        <td>$ <?php echo $subtotal; ?></td>
                        <td>
                            <form action="cart.php" method="POST">
                                <input type="hidden" name="idRopa" value="<?php echo $idRopa; ?>">
                                <input type="hidden" name="actionRopa" value="addRopa">
                                <input type="submit" value="Agregar más" style="background-color: #4CAF50; color: white; padding: 8px 16px; border: none; cursor: pointer;">
                            </form>
                            <br>
                            <form action="cart.php" method="POST">
                                <input type="hidden" name="idRopa" value="<?php echo $idRopa; ?>">
                                <input type="hidden" name="actionRopa" value="removeRopa">
                                <input type="submit" value="Eliminar" style="background-color: #f44336; color: white; padding: 8px 16px; border: none; cursor: pointer;">
                            </form>
                        </td>
                    </tr>
                    <?php
                }
            }?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3"></td>
                <td>Total:</td>
                <td>$ <?php echo $totalRopa; ?></td>
            </tr>
        </tfoot>
    </table>

    <!-- Tabla de Juguetes -->
    <h2 style="text-align: center;">Juguetes</h2>
    <table>
        <thead>
            <tr>
                <th>Producto</th>
                <th>Cantidad</th>
                <th>Precio unitario</th>
                <th>Subtotal</th>
                <th>Acciones</th>
            </tr>
        </thead>
        <tbody>
            <?php 
                $totalJuguete = 0;
                if (isset($_SESSION['carrito']['juguete'])) {
                    foreach ($_SESSION['carrito']['juguete'] as $idJuguete => $cantidadJuguete) { 
                        $dataJuguete = $juguete->get($idJuguete);
                        $subtotal = $cantidadJuguete * $dataJuguete[0]['precio'];
                        $totalJuguete += $subtotal;
                        ?>
                <tr>
                    <td><?php echo $dataJuguete[0]['juguete']; ?></td>
                    <td><?php echo $cantidadJuguete; ?></td>
                    <td>$ <?php echo $dataJuguete[0]['precio']; ?></td>
                    <td>$ <?php echo $subtotal; ?></td>
                    <td>
                        <form action="cart.php" method="POST">
                            <input type="hidden" name="idJuguete" value="<?php echo $idJuguete; ?>">
                            <input type="hidden" name="actionJuguete" value="addJuguete">
                            <input type="submit" value="Agregar más" style="background-color: #4CAF50; color: white; padding: 8px 16px; border: none; cursor: pointer;">
                        </form>
                        <br>
                        <form action="cart.php" method="POST">
                            <input type="hidden" name="idJuguete" value="<?php echo $idJuguete; ?>">
                            <input type="hidden" name="actionJuguete" value="removeJuguete">
                            <input type="submit" value="Eliminar" style="background-color: #f44336; color: white; padding: 8px 16px; border: none; cursor: pointer;">
                        </form>
                    </td>
                </tr>
            <?php } 
            }?>
        </tbody>
        <tfoot>
            <tr>
                <td colspan="3"></td>
                <td>Total:</td>
                <td>$ <?php echo $totalJuguete; ?></td>
            </tr>
        </tfoot>
    </table>

    <?php $totalCompra = $totalCalzado + $totalJuguete + $totalRopa; ?>

    <div style="display: flex; justify-content: center;">
        <label ><strong>Total compra: $ <?php echo $totalCompra; ?></strong></label>
    </div>
    
    <br>
    <div class="separator"></div>
    <br>

    <div style="display: flex; justify-content: center;">
        <form method="POST" action="procesar_compra.php" style="max-width: 500px;">
            <div class="form-group">
                <label for="direccion_entrega">Dirección de entrega:</label>
                <input type="text" class="form-control" id="direccion_entrega" name="direccion_entrega" required style="width: 100%; padding: 10px; font-size: 16px;">
            </div>
            <br>
            <input type="submit" name="finalizar_compra" value="Finalizar compra" class="btn btn-primary" >
        </form>
    </div>

    <br>
    <div class="separator"></div>
    <br>

    <?php include_once('views/footer_usuario.php');  ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>