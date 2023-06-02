<?php require_once(__DIR__.'/admin/controllers/sistema.php'); 
      require_once (__DIR__."/admin/controllers/ropa.php"); ?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ropa - P&P</title>
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

    <section class="hero pb-3 bg-cover bg-center d-flex align-items-center" style="background-image: url('admin/images/banner-ropa.jpg'); background-size: contain;">
        <div class="container py-5">
            <div class="row px-4 px-lg-5">
                <div class="col-lg-6">
                    <p class="text-muted small text-uppercase mb-2">Variedad de ropa</p>
                    <h1 class="h2 text-uppercase mb-3">Explora entre las diferentes prendas con las que contamos y encuentra la adecuada para tu bebé.</h1>
                </div>
            </div>
        </div>
    </section>

    <section id="calzado">
        <h2>Ropa</h2>
        <br>
        <div class="separator"></div>
        <br>
        <div class="container">
            <div class="row">
                <?php
                $data = $ropa->get();
                foreach ($data as $key => $ropa) {
                    ?>
                    <div class="col-md-3">
                        <div class="card">
                            <img src="admin/<?php echo $ropa['imagen']; ?>" alt="<?php echo $ropa['ropa']; ?>">
                            <div class="card-body">
                                <h3 class="card-title"><?php echo $ropa['ropa']; ?></h3>
                                <p class="card-price">$<?php echo $ropa['precio']; ?></p>
                                <a href="detalle_ropa.php?id=<?php echo $ropa['id_ropa']; ?>" class="btn">Ver detalle</a>
                            </div>
                        </div>
                    </div>
                    <?php
                }
                ?>
            </div>
        </div>
    </section>

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