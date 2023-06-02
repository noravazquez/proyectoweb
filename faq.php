<?php require_once(__DIR__.'/admin/controllers/sistema.php'); 
      $sistema->db(); ?>
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


    <section class="hero pb-3 bg-cover bg-center d-flex align-items-center" style="background-image: url('admin/images/banner-faq.jpg'); background-size: contain;">
        <div class="container py-5">
            <div class="row px-4 px-lg-5">
                <div class="col-lg-6">
                    <p class="text-muted small text-uppercase mb-2">Preguntas frecuentes</p>
                    <h1 class="h2 text-uppercase mb-3">Encuentra las preguntas frecuentes que nos hacen</h1>
                </div>
            </div>
        </div>
    </section>

    <div class="help-about faq-sec">
        <div class="container">
            <h3 class="section-heading">¿En que podemos ayudarte?</h3>
            <div class="faq-wrapper">
                <h5 class="faq-title">Top preguntas mas fecuentes</h5>
                <ul class="faq-list">
                    <li>
                        <div class="question">
                            <a href="#" title="click here">¿Cuáles son los métodos de pago aceptados?</a>
                        </div>
                        <div class="answer">
                            <p> Aceptamos los siguientes métodos de pago: tarjetas de crédito (Visa, Mastercard, American Express), 
                            PayPal y transferencia bancaria.</p>
                        </div>
                    </li>
                    <li class="item2">
                        <div class="question">
                            <a href="#" title="click here">¿Cuánto tiempo tarda en llegar mi pedido?</a>
                        </div>
                        <div class="answer">
                            <p> El tiempo de entrega depende de tu ubicación. Por lo general, nuestros envíos tardan entre 3 y 7 días 
                            hábiles. Una vez que realices tu pedido, te proporcionaremos un número de seguimiento para que puedas 
                            rastrearlo.</p>
                        </div>
                    </li>
                    <li class="item3">
                        <div class="question">
                            <a href="#" title="click here">¿Cuáles son los gastos de envío?</a>
                        </div>
                        <div class="answer">
                            <p>Los gastos de envío varían según el destino y el peso de los productos. Puedes consultar los costos exactos 
                            durante el proceso de compra, antes de finalizar tu pedido.</p>
                        </div>
                    </li>
                    <li class="item4">
                        <div class="question">
                            <a href="#" title="click here">¿Puedo realizar cambios o devoluciones?</a>
                        </div>
                        <div class="answer">
                            <p>Sí, aceptamos cambios y devoluciones dentro de los 30 días posteriores a la recepción de tu pedido. El 
                            producto debe estar en su estado original, sin usar y con todas las etiquetas y empaques intactos. Por 
                            favor, ponte en contacto con nuestro servicio de atención al cliente para iniciar el proceso.</p>
                        </div>
                    </li>
                    <li class="item5">
                        <div class="question">
                            <a href="#" title="click here">¿Cómo puedo contactar al servicio de atención al cliente?</a>
                        </div>
                        <div>
                            <p>Puedes contactarnos a través de nuestro número de teléfono: 417 113 5891, 
                            nuestro correo electrónico: dildanoces91@gmail.com o mediante nuestro formulario de contacto en 
                            nuestro sitio web. Estamos disponibles para ayudarte de lunes a viernes, de 9:00 a.m. a 6:00 p.m.</p>
                        </div>
                    </li>
                </ul>
            </div>
        </div>
    </div>

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