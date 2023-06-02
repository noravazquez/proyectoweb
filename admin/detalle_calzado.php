<?php require_once(__DIR__.'/controllers/sistema.php'); 
      require_once(__DIR__.'/controllers/calzado.php');
      require_once(__DIR__.'/controllers/comentario_calzado.php');
      require_once (__DIR__."/controllers/cliente.php");
      require_once (__DIR__."/controllers/usuario.php");
      require '../vendor/autoload.php';
      $sistema->validateRolUsuario('Usuario');?> 
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PiccoliGlam & Piccolino's</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/index_style.css">
</head>
<body>
    <?php include_once('views/menu_usuario.php');  ?>

    <?php $idCalzado = (isset($_GET['id'])) ? $_GET['id'] : null; ?>

    <br>
    <h2 style="text-align: center;">Detalle calzado</h2>
    <div class="separator"></div>
    <br>

    <div class="product-detail">
        <?php
        $data = $calzado->get($idCalzado);
        foreach ($data as $key => $producto) {
            $contenidoQR = 'Calzado: ' . $producto['calzado'] . PHP_EOL . 'Descripción: ' . $producto['descripcion'] . PHP_EOL . 'Precio: $' . $producto['precio'];

            $qr = (new \chillerlan\QRCode\QRCode())->render($contenidoQR);
        ?>
            <div class="card-detail">
                <div class="col">
                    <div class="product-image">
                        <img src="<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['calzado']; ?>" class="highlight-image">
                    </div>
                </div>
                <div class="col">
                    <div class="row">
                        <div class="col-6">
                            <div class="product-info">
                                <h3><?php echo $producto['calzado']; ?></h3>
                                <p><?php echo $producto['descripcion']; ?></p>
                                <div class="details">
                                    <div class="detail-row">
                                        <span class="label">Precio:</span>
                                        <span class="value">$<?php echo $producto['precio']; ?></span>
                                    </div>
                                    <div class="detail-row">
                                        <span class="label">Estado:</span>
                                        <span class="value"><?php echo ($producto['estado'] == 1) ? 'Nuevo' : 'Seminuevo'; ?></span>
                                    </div>
                                    <div class="detail-row">
                                        <span class="label">Color:</span>
                                        <span class="value"><?php echo $producto['color']; ?></span>
                                    </div>
                                    <div class="detail-row">
                                        <span class="label">Categoría:</span>
                                        <span class="value"><?php echo $producto['categoria_calzado']; ?></span>
                                    </div>
                                    <div class="detail-row">
                                        <span class="label">Marca:</span>
                                        <span class="value"><?php echo $producto['marca_calzado']; ?></span>
                                    </div>
                                    <div class="detail-row">
                                        <span class="label">Talla:</span>
                                        <span class="value"><?php echo $producto['talla_calzado']; ?></span>
                                    </div>
                                    <div class="detail-row">
                                        <span class="label">Sucursal:</span>
                                        <span class="value"><?php echo $producto['sucursal']; ?></span>
                                    </div>
                                    <?php if ($producto['stock'] > 0) { ?>
                                        <form action="detalle_calzado.php?id=<?php echo $idCalzado; ?>" method="POST">
                                            <input type="hidden" name="idCalzado" value="<?php echo $idCalzado; ?>">
                                            <input type="submit" name="agregarCarrito" value="Agregar al carrito" class="btn btn-primary" >
                                        </form>
                                    <?php } else { ?>
                                        <span class="label">No disponible</span>
                                    <?php } ?>
                                </div>
                            </div>
                        </div>
                        <div class = "col-6 align-items-center justify-content-center"><?php echo "<img src='$qr'>"; ?></div>
                    </div>
                </div>
            </div>
        <?php
        }
        ?>
    </div>
    <br>
    <div class="separator"></div>
    <br>
    <?php
        $comentarios = $calzado->getComentarios($idCalzado);

        // Mostrar los comentarios
        if (!empty($comentarios)) {
            ?>
            <h4 style="text-align: center;">Comentarios:</h4>
            <?php
                foreach ($comentarios as $comentario) {
                    ?>
                    <div class="comment">
                        <div class="user-info">
                            <img src="<?php echo $comentario['imagen']; ?>" alt="Imagen de usuario">
                            <p>
                                <strong>Nombre:</strong> <?php echo $comentario['nombre']; ?>
                                <?php echo $comentario['apellido_paterno']; ?>
                                <?php echo $comentario['apellido_materno']; ?>
                            </p>
                        </div>
                        <p><strong>Correo electrónico:</strong> <?php echo $comentario['correo']; ?></p>
                        <p><strong>Fecha:</strong> <?php echo $comentario['fecha_comentario']; ?></p>
                        <p><strong>Comentario:</strong> <?php echo $comentario['comentario_calzado']; ?></p>
                    </div>
                    <?php
                }
        } else {
            echo '<p>No hay comentarios para este calzado.</p>';
        }
    ?>
    <br>
    <div class="separator"></div>
    <br>
    <!--Agregar comentario aqui-->
    <h4 style="text-align: center;">Agregar Comentario:</h4>
    <div style="display: flex; justify-content: center;">
        <form action="detalle_calzado.php?id=<?php echo $idCalzado; ?>" method="POST" style="max-width: 500px;">
            <label for="comentario" style="margin-bottom: 5px;">Comentario: </label>
            <textarea id="comentario" name="data[comentario_calzado]" required style="width: 100%; padding: 10px; border: 1px solid #ccc; border-radius: 4px; margin-bottom: 10px;"></textarea>

            <input type="submit" name="enviar" value="Guardar" class="btn btn-primary" style="background-color: #007bff; color: #fff; padding: 10px 20px; border: none; border-radius: 4px; cursor: pointer;">
            <input type="hidden" name="data[id_calzado]" value="<?php echo ($idCalzado); ?>">
        </form>
    </div>
    <br>
    <?php 
        if (isset($_POST['enviar'])) {
            $data = $_POST['data'];
            $idCliente = $cliente->getIdCliente($_SESSION['id_usuario']); 
            $cantidad = $comentario_calzado->newComentario($data, $idCliente);
            if ($cantidad) {
                $comentario_calzado->alert('success', 'bi bi-check-circle-fill', 'NUEVO COMENTARIO CALZADO', 'El comentario del calzado fue agregado correctamente.');
            } else {
                $comentario_calzado->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
            }
        }
        if (isset($_POST['agregarCarrito'])) {
            $idCalzado = $_POST['idCalzado'];

            // Verificar si el calzado ya está en el carrito
            if (isset($_SESSION['carrito']['calzado'][$idCalzado])) {
                // Incrementar la cantidad si ya está en el carrito
                $_SESSION['carrito']['calzado'][$idCalzado]++;
            } else {
                // Agregar el calzado al carrito con cantidad 1
                $_SESSION['carrito']['calzado'][$idCalzado] = 1;
            }
        }
    ?>
    <?php include_once('views/footer_usuario.php');  ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>