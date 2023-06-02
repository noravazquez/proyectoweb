<?php require_once(__DIR__.'/admin/controllers/sistema.php'); 
      require_once(__DIR__.'/admin/controllers/sucursal.php');  ?>
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


    <section class="hero pb-3 bg-cover bg-center d-flex align-items-center" style="background-image: url('admin/images/banner-sucursales.jpg'); background-size: contain;">
        <div class="container py-5">
            <div class="row px-4 px-lg-5">
                <div class="col-lg-6">
                    <p class="text-muted small text-uppercase mb-2">Nuestras sucursales</p>
                    <h1 class="h2 text-uppercase mb-3">Visitanos en nuestras diferentes sucursales</h1>
                </div>
            </div>
        </div>
    </section>

    <section id="destacados">
        <div class="container">
            <?php $data = $sucursal->get(); ?>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo ($data[0]['sucursal']); ?></h5>
                        <div id="map1" class="map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3748.3915408618404!2d-100.7244216255463!3d20.034036221200733!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x842cd66e08b7c093%3A0xbaa5bb8b3c35e4cf!2sAv.%20Guerrero%2012%2C%20Zona%20Centro%2C%2038600%20Ac%C3%A1mbaro%2C%20Gto.!5e0!3m2!1ses!2smx!4v1685574432029!5m2!1ses!2smx" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                        <p class="card-text"><?php echo ($data[0]['direccion']); ?></p>
                        <!-- Otros detalles o información adicional de la sucursal 1 -->
                    </div>
                    </div>
                </div>
            </div>
            <br>
            <div class="separator"></div>
            <br>
            <div class="row">
                <div class="col-md-12">
                    <div class="card">
                    <div class="card-body">
                        <h5 class="card-title"><?php echo ($data[1]['sucursal']); ?></h5>
                        <div id="map1" class="map">
                        <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3748.3988053447847!2d-100.72427258255615!3d20.033731700000008!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x842cd66e09f9d45f%3A0x2fabd361de61a3b4!2sJos%C3%A9%20Mar%C3%ADa%20Morelos%20595%2C%20Zona%20Centro%2C%2038600%20Ac%C3%A1mbaro%2C%20Gto.!5e0!3m2!1ses!2smx!4v1685574627030!5m2!1ses!2smx" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
                        </div>
                        <p class="card-text"><?php echo ($data[1]['direccion']); ?></p>
                        <!-- Otros detalles o información adicional de la sucursal 1 -->
                    </div>
                    </div>
                </div>
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