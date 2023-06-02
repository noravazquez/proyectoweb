<?php include_once(__DIR__."/controllers/sistema.php"); 
      $sistema->validateRol('Usuario');
      include_once(__DIR__."/controllers/comentario_ropa.php"); 
      include_once(__DIR__."/controllers/comentario_calzado.php"); 
      include_once(__DIR__."/controllers/comentario_juguete.php");
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

    <div class="card-container">
        <br>
        <h2 style="text-align: center;">Comentarios calzado</h2>
        <div class="separator"></div>
        <br>
        <?php $idCliente = $cliente->getIdCliente($_SESSION['id_usuario']);
            $comentariosCalzado = $comentario_calzado->getComentarioCliente($idCliente);
            foreach ($comentariosCalzado as $comentario) : ?>
                <div class="comment">
                    <div class="user-info">
                        <p>
                            <strong>Calzado:</strong> <?php echo $comentario['calzado']; ?>
                        </p>
                    </div>
                    <p><strong>Fecha:</strong> <?php echo $comentario['fecha_comentario']; ?></p>
                    <p><strong>Comentario:</strong> <?php echo $comentario['comentario_calzado']; ?></p>
                </div>
        <?php endforeach; ?>

        <br>
        <h2 style="text-align: center;">Comentarios juguete</h2>
        <div class="separator"></div>
        <br>
        <?php $idCliente = $cliente->getIdCliente($_SESSION['id_usuario']);
            $comentariosJuguete = $comentario_juguete->getComentarioCliente($idCliente);
            foreach ($comentariosJuguete as $comentario) : ?>
                <div class="comment">
                    <div class="user-info">
                        <p>
                            <strong>Juguete:</strong> <?php echo $comentario['juguete']; ?>
                        </p>
                    </div>
                    <p><strong>Fecha:</strong> <?php echo $comentario['fecha_comentario']; ?></p>
                    <p><strong>Comentario:</strong> <?php echo $comentario['comentario_juguete']; ?></p>
                </div>
        <?php endforeach; ?>

        <br>
        <h2 style="text-align: center;">Comentarios ropa</h2>
        <div class="separator"></div>
        <br>
        <?php $idCliente = $cliente->getIdCliente($_SESSION['id_usuario']);
            $comentariosRopa = $comentario_ropa->getComentarioCliente($idCliente);
            foreach ($comentariosRopa as $comentario) : ?>
                <div class="comment">
                    <div class="user-info">
                        <p>
                            <strong>Ropa:</strong> <?php echo $comentario['ropa']; ?>
                        </p>
                    </div>
                    <p><strong>Fecha:</strong> <?php echo $comentario['fecha_comentario']; ?></p>
                    <p><strong>Comentario:</strong> <?php echo $comentario['comentario_ropa']; ?></p>
                </div>
        <?php endforeach; ?>

    </div>

    <?php include_once('views/footer_usuario.php');  ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>