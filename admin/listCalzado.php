<?php require_once(__DIR__.'/controllers/sistema.php'); 
      require_once (__DIR__."/controllers/calzado.php"); 
      require_once (__DIR__."/controllers/categoria_calzado.php");
      require_once (__DIR__."/controllers/marca_calzado.php");
      require_once (__DIR__."/controllers/talla_calzado.php");
      require_once (__DIR__."/controllers/sucursal.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Calzado - P&P</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/user.css">
</head>
<body>
    <?php include_once('views/menu_usuario.php');  ?>

    <section class="hero pb-3 bg-cover bg-center d-flex align-items-center" style="background-image: url('images/banner-calzado.jpg'); background-size: contain;">
        <div class="container py-5">
            <div class="row px-4 px-lg-5">
                <div class="col-lg-6">
                    <p class="text-muted small text-uppercase mb-2">Variedad de calzado</p>
                    <h1 class="h2 text-uppercase mb-3">Explora entre los diferentes calzados con los que contamos y encuentra el perfecto para tu bebé.</h1>
                </div>
            </div>
        </div>
    </section>

    <section id="calzado">
        <h2>Calzado</h2>
        <br>
        <div class="separator"></div>
        <br>
        <div class="container">
            <div class="row">
                <?php
                $data = $calzado->get(); // Llamar a la función para obtener los datos de los calzados
                foreach ($data as $key => $calzado) {
                    ?>
                    <div class="col-md-3">
                        <div class="card">
                            <img src="<?php echo $calzado['imagen']; ?>" alt="<?php echo $calzado['calzado']; ?>">
                            <div class="card-body">
                                <h3 class="card-title"><?php echo $calzado['calzado']; ?></h3>
                                <p class="card-price">$<?php echo $calzado['precio']; ?></p>
                                <a href="detalle_calzado.php?id=<?php echo $calzado['id_calzado']; ?>" class="btn">Ver detalle</a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </section>

    <?php include_once('views/footer_usuario.php');  ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
</body>
</html>