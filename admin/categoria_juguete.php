<?php require_once (__DIR__."/controllers/categoria_juguete.php"); ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD CATEGORIAS DE JUGUETES</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css"> 
  </head>
  <body>
    <?php
        if (in_array('Administrador', $_SESSION['roles'])) {
          include_once('views/menu_admin.php');
        }else if (in_array('Gerente', $_SESSION['roles'])) {
          include_once('views/menu_gerente.php');
        }else if (in_array('Dependiente', $_SESSION['roles'])) {
          include_once('views/menu_dependiente.php');
        }
        $action = (isset($_GET['action'])) ? $_GET['action'] : 'get';
        $idCategoriaJuguete = (isset($_GET['id'])) ? $_GET['id'] : null;

        switch ($action) {
          case 'new':
            $categoria_juguete->validatePrivilegio('Categoria juguete crear');
            if (isset($_POST['enviar'])) {
              $data = $_POST['data'];
              $cantidad = $categoria_juguete->new($data);
              if ($cantidad) {
                $categoria_juguete->alert('success', 'bi bi-check-circle-fill', 'NUEVA CATEGORIA DE JUGUETE', 'La categoria de juguete fue agregada correctamente.');
                $data = $categoria_juguete->get();
                include('views/categoria_juguete/index.php');
              } else {
                $categoria_juguete->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
                $data = $categoria_juguete->get();
                include('views/categoria_juguete/index.php');
              }
            }else {
              include('views/categoria_juguete/form.php');
            } 
          break;
          case 'delete':
            $categoria_juguete->validatePrivilegio('Categoria juguete eliminar');
            $cantidad = $categoria_juguete->delete($idCategoriaJuguete);
            if ($cantidad) {
              $categoria_juguete->alert('success', 'bi bi-check-circle-fill', 'CATEGORIA DE JUGUETE ELIMINADA', 'La categoria de juguete fue eliminada correctamente.');
              $data = $categoria_juguete->get();
              include('views/categoria_juguete/index.php');
            } else {
              $categoria_juguete->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
              $data = $categoria_juguete->get();
              include('views/categoria_juguete/index.php');
            }
          break;
          case 'edit':
            $categoria_juguete->validatePrivilegio('Categoria juguete editar');
            if (isset($_POST['enviar'])) {
              $data = $_POST['data'];
              $idCategoriaJuguete = $_POST['data']['id_categoria_juguete'];
              $cantidad = $categoria_juguete->edit($idCategoriaJuguete, $data);
              if ($cantidad) {
                $categoria_juguete->alert('success', 'bi bi-check-circle-fill', 'CATEGORIA DE JUGUETE ACTUALIZADA', 'La categoria de juguete fue actualizada correctamente.');
                $data = $categoria_juguete->get();
                include('views/categoria_juguete/index.php');
              } else {
                $categoria_juguete->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
                $data = $categoria_juguete->get();
                include('views/categoria_juguete/index.php');
              }
            }else {
              $data = $categoria_juguete->get($idCategoriaJuguete);
              include('views/categoria_juguete/form.php');
            }
          break;
          case 'get':
          default:
            $categoria_juguete->validatePrivilegio('Categoria juguete leer');
            $data = $categoria_juguete->get();
            include('views/categoria_juguete/index.php');
          break;
        }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>