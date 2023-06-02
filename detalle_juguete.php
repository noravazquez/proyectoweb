<?php require_once(__DIR__.'/admin/controllers/sistema.php'); 
      require_once(__DIR__.'/admin/controllers/juguete.php');
      require 'vendor/autoload.php';  ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PiccoliGlam & Piccolino's</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="admin/css/index_style.css">
</head>
<body>
    <header>
        <nav>
            <div class="navbar-top">
                <div class="logo">
                    <a class="navbar-brand" href="index.php">
                        <img id="logo" src="/picco/admin/images/logo.png" alt="Logo" draggable="false" height="100"/>
                    </a>
                </div>
                <div class="login flex-column align-items-center justify-content-center">
                    <ul class="navbar-nav">
                        <li class="nav-item"><a class="nav-link" href="admin/login.php" style="font-size: 15px;"> <i class="bi bi-door-open-fill" style="font-size: 1.5rem; margin-right: 0.5rem;"></i>Login</a></li>
                    </ul>
                </div>
            </div>
            <div class="navbar-bottom">
                <ul>
                    <li><a href="index.php">Inicio</a></li>
                    <li><a href="listCalzado.php">Calzado</a></li>
                    <li><a href="listRopa.php">Ropa</a></li>
                    <li><a href="listJuguete.php">Juguetes</a></li>
                    <li><a href="faq.php">Preguntas mas frecuentes</a></li>
                    <li><a href="sucursales.php">¿Donde nos ubicamos?</a></li>
                </ul>
            </div>
        </nav>
    </header>

    <?php $idJuguete = (isset($_GET['id'])) ? $_GET['id'] : null; ?>

    <br>
    <h2 style="text-align: center;">Detalle juguete</h2>
    <div class="separator"></div>
    <br>

    <div class="product-detail">
        <?php
        $data = $juguete->get($idJuguete);
        foreach ($data as $key => $producto) {
            $contenidoQR = 'Juguete: ' . $producto['juguete'] . PHP_EOL . 'Descripción: ' . $producto['descripcion'] . PHP_EOL . 'Precio: $' . $producto['precio'];

            $qr = (new \chillerlan\QRCode\QRCode())->render($contenidoQR);
        ?>
            <div class="card-detail">
                <div class="col">
                    <div class="product-image">
                        <img src="admin/<?php echo $producto['imagen']; ?>" alt="<?php echo $producto['juguete']; ?>" class="highlight-image">
                    </div>
                </div>
                <div class="col">
                    <div class ="row">
                        <div class = "col-6">
                            <div class="product-info">
                                <h3><?php echo $producto['juguete']; ?></h3>
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
                                        <span class="label">Edad recomendada:</span>
                                        <span class="value"><?php echo $producto['edad_recomendada']; ?></span>
                                    </div>
                                    <div class="detail-row">
                                        <span class="label">Categoría:</span>
                                        <span class="value"><?php echo $producto['categoria_juguete']; ?></span>
                                    </div>
                                    <div class="detail-row">
                                        <span class="label">Marca:</span>
                                        <span class="value"><?php echo $producto['marca_juguete']; ?></span>
                                    </div>
                                    <div class="detail-row">
                                        <span class="label">Sucursal:</span>
                                        <span class="value"><?php echo $producto['sucursal']; ?></span>
                                    </div>
                                    <?php if ($producto['stock'] > 0) { ?>
                                        <div class="detail-row">
                                            <span class="label">Para comprar el producto inicie sesión o cree una cuenta.</span>
                                        </div>
                                    <?php } else { ?>
                                        <p>No disponible</p>
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
        $comentarios = $juguete->getComentarios($idJuguete);

        // Mostrar los comentarios
        if (!empty($comentarios)) {
            ?>
            <h4 style="text-align: center;">Comentarios:</h4>
            <?php
                foreach ($comentarios as $comentario) {
                    ?>
                    <div class="comment">
                        <div class="user-info">
                            <img src="admin/<?php echo $comentario['imagen']; ?>" alt="Imagen de usuario">
                            <p>
                                <strong>Nombre:</strong> <?php echo $comentario['nombre']; ?>
                                <?php echo $comentario['apellido_paterno']; ?>
                                <?php echo $comentario['apellido_materno']; ?>
                            </p>
                        </div>
                        <p><strong>Correo electrónico:</strong> <?php echo $comentario['correo']; ?></p>
                        <p><strong>Fecha:</strong> <?php echo $comentario['fecha_comentario']; ?></p>
                        <p><strong>Comentario:</strong> <?php echo $comentario['comentario_juguete']; ?></p>
                    </div>
                    <?php
                }
        } else {
            echo '<p>No hay comentarios para este juguete.</p>';
        }
    ?>

    <footer>
        <div class="redes-sociales">
            <h4>Redes Sociales</h4>
            <ul>
            <li><a href="https://www.facebook.com/piccoliglam"><i class="bi bi-facebook"></i> Facebook PiccoliGlam</a></li>
            <li><a href="https://www.facebook.com/piccolinosropa"><i class="bi bi-facebook"></i> Facebook Piccolino's</a></li>
            </ul>
        </div>
        <div class="contacto">
            <h4>Contacto</h4>
            <p><i class="bi bi-whatsapp"></i> WhatsApp: 417 113 5891</p>
            <p><i class="bi bi-envelope-fill"></i> Email: dildanoces91@gmail.com</p>
        </div>
        <div class="about-us">
            <h4>About Us</h4>
            <p>Ropa, accesorios de importación, marcas distinguidas a un excelente precio.</p>
            <p>Ofrecemos amplio surtido en ropa de niño y ropa deportiva para adulto (americana) exelente calidad.</p>
        </div>
    </footer>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>