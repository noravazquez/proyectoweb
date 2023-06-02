<?php require_once (__DIR__."/controllers/categoria_ropa.php");
      include_once(__DIR__."/controllers/sistema.php"); 
      $sistema->validateRol('Administrador'); ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD CATEGORIAS DE ROPA</title>
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
        $idCategoriaRopa = (isset($_GET['id'])) ? $_GET['id'] : null;

        switch ($action) {
          case 'new':
            $categoria_ropa->validatePrivilegio('Categoria ropa crear');
            if (isset($_POST['enviar'])) {
              $data = $_POST['data'];
              $cantidad = $categoria_ropa->new($data);
              if ($cantidad) {
                $categoria_ropa->alert('success', 'bi bi-check-circle-fill', 'NUEVA CATEGORIA DE ROPA', 'La categoria de ropa fue agregada correctamente.');
                $data = $categoria_ropa->get();
                include('views/categoria_ropa/index.php');
              } else {
                $categoria_ropa->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
                $data = $categoria_ropa->get();
                include('views/categoria_ropa/index.php');
              }
            }else {
              include('views/categoria_ropa/form.php');
            } 
          break;
          case 'delete':
            $categoria_ropa->validatePrivilegio('Categoria ropa eliminar');
            $cantidad = $categoria_ropa->delete($idCategoriaRopa);
            if ($cantidad) {
              $categoria_ropa->alert('success', 'bi bi-check-circle-fill', 'CATEGORIA DE ROPA ELIMINADA', 'La categoria de ropa fue eliminada correctamente.');
              $data = $categoria_ropa->get();
              include('views/categoria_ropa/index.php');
            } else {
              $categoria_ropa->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
              $data = $categoria_ropa->get();
              include('views/categoria_ropa/index.php');
            }
          break;
          case 'edit':
            $categoria_ropa->validatePrivilegio('Categoria ropa editar');
            if (isset($_POST['enviar'])) {
              $data = $_POST['data'];
              $idCategoriaRopa = $_POST['data']['id_categoria_ropa'];
              $cantidad = $categoria_ropa->edit($idCategoriaRopa, $data);
              if ($cantidad) {
                $categoria_ropa->alert('success', 'bi bi-check-circle-fill', 'CATEGORIA DE ROPA ACTUALIZADA', 'La categoria de ropa fue actualizada correctamente.');
                $data = $categoria_ropa->get();
                include('views/categoria_ropa/index.php');
              } else {
                $categoria_ropa->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
                $data = $categoria_ropa->get();
                include('views/categoria_ropa/index.php');
              }
            }else {
              $data = $categoria_ropa->get($idCategoriaRopa);
              include('views/categoria_ropa/form.php');
            }
          break;
          case 'get':
          default:
            $categoria_ropa->validatePrivilegio('Categoria ropa leer');
            $data = $categoria_ropa->get();
            include('views/categoria_ropa/index.php');
          break;
        }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>