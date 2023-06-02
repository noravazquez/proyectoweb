<?php include_once(__DIR__."/controllers/sistema.php"); 
      $sistema->validateRol('Usuario');
      $sistema->db(); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>PiccoliGlam & Piccolino's</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/user.css">
</head>
<body>
    <?php include_once('views/menu_usuario.php');  ?>

    <section class="hero pb-3 bg-cover bg-center d-flex align-items-center" style="background-image: url('images/banner-picco.jpg'); background-size: contain;">
        <div class="container py-5">
            <div class="row px-4 px-lg-5">
                <div class="col-lg-6">
                    <p class="text-muted small text-uppercase mb-2">Primavera - Verano 2023</p>
                    <h1 class="h2 text-uppercase mb-3">15% de descuento en esta temporada</h1>
                </div>
            </div>
        </div>
    </section>

    <section id="destacados">
        <h2>Juguetes Destacados</h2>
        <div class="productos">
            <?php
                $sql = "SELECT j.id_juguete, j.juguete, j.descripcion, j.precio, j.stock, j.edad_recomendada, j.imagen, SUM(dpj.cantidad) AS cantidad_vendida FROM juguete j INNER JOIN categoria_juguete cj ON j.id_categoria_juguete = cj.id_categoria_juguete INNER JOIN marca_juguete mj ON j.id_marca_juguete = mj.id_marca_juguete INNER JOIN detalle_pedido_juguete dpj ON j.id_juguete = dpj.id_juguete GROUP BY j.id_juguete ORDER BY cantidad_vendida DESC LIMIT 3";
                $st = $sistema->db->prepare($sql);
                $st->execute();
                $juguetesDestacados = $st->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <div class="producto">
                <img src="<?php echo $juguetesDestacados[0]['imagen']; ?>" alt="Juguete destacado 1">
                <h3><?php echo $juguetesDestacados[0]['juguete']; ?></h3>
                <p>$ <?php echo $juguetesDestacados[0]['precio']; ?></p>
                <a href="detalle_juguete.php?id=<?php echo $juguetesDestacados[0]['id_juguete']; ?>" class="btn">Ver detalle</a>
            </div>
            <div class="producto">
                <img src="<?php echo $juguetesDestacados[1]['imagen']; ?>" alt="Juguete destacado 2">
                <h3><?php echo $juguetesDestacados[1]['juguete']; ?></h3>
                <p>$ <?php echo $juguetesDestacados[1]['precio']; ?></p>
                <a href="detalle_juguete.php?id=<?php echo $juguetesDestacados[1]['id_juguete']; ?>" class="btn">Ver detalle</a>
            </div>
            <div class="producto">
                <img src="<?php echo $juguetesDestacados[2]['imagen']; ?>" alt="Juguete destacado 3">
                <h3><?php echo $juguetesDestacados[2]['juguete']; ?></h3>
                <p>$ <?php echo $juguetesDestacados[2]['precio']; ?></p>
                <a href="detalle_juguete.php?id=<?php echo $juguetesDestacados[2]['id_juguete']; ?>" class="btn">Ver detalle</a>
            </div>
        </div>

        <div class="separator"></div>

        <h2>Ropa Destacada</h2>
        <div class="productos">
            <?php
                $sql = "SELECT r.id_ropa, r.ropa, r.descripcion, r.precio, r.stock, r.color, r.imagen, cr.categoria_ropa, mr.marca_ropa, tr.talla_ropa, SUM(dpr.cantidad) AS cantidad_vendida FROM ropa r INNER JOIN categoria_ropa cr ON r.id_categoria_ropa = cr.id_categoria_ropa INNER JOIN talla_ropa tr ON r.id_talla_ropa = tr.id_talla_ropa INNER JOIN marca_ropa mr ON r.id_marca_ropa = mr.id_marca_ropa INNER JOIN detalle_pedido_ropa dpr ON r.id_ropa = dpr.id_ropa GROUP BY r.ropa ORDER BY cantidad_vendida DESC LIMIT 3";
                $st = $sistema->db->prepare($sql);
                $st->execute();
                $ropaDestacada = $st->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <div class="producto">
                <img src="<?php echo $ropaDestacada[0]['imagen']; ?>" alt="Ropa destacada 1">
                <h3><?php echo $ropaDestacada[0]['ropa']; ?></h3>
                <p>$ <?php echo $ropaDestacada[0]['precio']; ?></p>
                <a href="detalle_ropa.php?id=<?php echo $ropaDestacada[0]['id_ropa']; ?>" class="btn">Ver detalle</a>
            </div>
            <div class="producto">
                <img src="<?php echo $ropaDestacada[1]['imagen']; ?>" alt="Ropa destacada 2">
                <h3><?php echo $ropaDestacada[1]['ropa']; ?></h3>
                <p>$ <?php echo $ropaDestacada[1]['precio']; ?></p>
                <a href="detalle_ropa.php?id=<?php echo $ropaDestacada[1]['id_ropa']; ?>" class="btn">Ver detalle</a>
            </div>
            <div class="producto">
                <img src="<?php echo $ropaDestacada[2]['imagen']; ?>" alt="Ropa destacada 3">
                <h3><?php echo $ropaDestacada[2]['ropa']; ?></h3>
                <p>$ <?php echo $ropaDestacada[2]['precio']; ?></p>
                <a href="detalle_ropa.php?id=<?php echo $ropaDestacada[2]['id_ropa']; ?>" class="btn">Ver detalle</a>
            </div>
        </div>

        <div class="separator"></div>

        <h2>Calzado Destacado</h2>
        <div class="productos">
            <?php
                $sql = "SELECT c.id_calzado, c.calzado, c.descripcion, c.precio, c.stock, c.color, c.imagen, cc.categoria_calzado, mc.marca_calzado, tc.talla_calzado, SUM(dpc.cantidad) AS cantidad_vendida FROM calzado c INNER JOIN categoria_calzado cc ON c.id_categoria_calzado = cc.id_categoria_calzado INNER JOIN talla_calzado tc ON c.id_talla_calzado = tc.id_talla_calzado INNER JOIN marca_calzado mc ON c.id_marca_calzado = mc.id_marca_calzado INNER JOIN detalle_pedido_calzado dpc ON c.id_calzado = dpc.id_calzado GROUP BY c.calzado ORDER BY cantidad_vendida DESC LIMIT 3";
                $st = $sistema->db->prepare($sql);
                $st->execute();
                $calzadoDestacado = $st->fetchAll(PDO::FETCH_ASSOC);
            ?>
            <div class="producto">
                <img src="<?php echo $calzadoDestacado[0]['imagen']; ?>" alt="Calzado destacado 1">
                <h3><?php echo $calzadoDestacado[0]['calzado']; ?></h3>
                <p>$ <?php echo $calzadoDestacado[0]['precio']; ?></p>
                <a href="detalle_calzado.php?id=<?php echo $calzadoDestacado[0]['id_calzado']; ?>" class="btn">Ver detalle</a>
            </div>
            <div class="producto">
                <img src="<?php echo $calzadoDestacado[1]['imagen']; ?>" alt="Calzado destacado 2">
                <h3><?php echo $calzadoDestacado[1]['calzado']; ?></h3>
                <p>$ <?php echo $calzadoDestacado[1]['precio']; ?></p>
                <a href="detalle_calzado.php?id=<?php echo $calzadoDestacado[1]['id_calzado']; ?>" class="btn">Ver detalle</a>
            </div>
            <div class="producto">
                <img src="<?php echo $calzadoDestacado[2]['imagen']; ?>" alt="Calzado destacado 3">
                <h3><?php echo $calzadoDestacado[2]['calzado']; ?></h3>
                <p>$ <?php echo $calzadoDestacado[2]['precio']; ?></p>
                <a href="detalle_calzado.php?id=<?php echo $calzadoDestacado[2]['id_calzado']; ?>" class="btn">Ver detalle</a>
            </div>
        </div>
    </section>

    <?php include_once('views/footer_usuario.php');  ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>