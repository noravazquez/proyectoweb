<?php require_once (__DIR__."/controllers/categoria_calzado.php"); 
      include_once(__DIR__."/controllers/sistema.php"); 
      $sistema->validateRol('Administrador');  ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD CATEGORIAS DE CALZADO</title>
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
        $idCategoriaCalzado = (isset($_GET['id'])) ? $_GET['id'] : null;

        switch ($action) {
          case 'new':
            $categoria_calzado->validatePrivilegio('Categoria calzado crear');
            if (isset($_POST['enviar'])) {
              $data = $_POST['data'];
              $cantidad = $categoria_calzado->new($data);
              if ($cantidad) {
                $categoria_calzado->alert('success', 'bi bi-check-circle-fill', 'NUEVA CATEGORIA DE CALZADO', 'La categoria de calzado fue agregada correctamente.');
                $data = $categoria_calzado->get();
                include('views/categoria_calzado/index.php');
              } else {
                $categoria_calzado->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
                $data = $categoria_calzado->get();
                include('views/categoria_calzado/index.php');
              }
            }else {
              include('views/categoria_calzado/form.php');
            } 
          break;
          case 'delete':
            $categoria_calzado->validatePrivilegio('Categoria calzado eliminar');
            $cantidad = $categoria_calzado->delete($idCategoriaCalzado);
            if ($cantidad) {
              $categoria_calzado->alert('success', 'bi bi-check-circle-fill', 'CATEGORIA DE CALZADO ELIMINADA', 'La categoria de calzado fue eliminada correctamente.');
              $data = $categoria_calzado->get();
              include('views/categoria_calzado/index.php');
            } else {
              $categoria_calzado->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
              $data = $categoria_calzado->get();
              include('views/categoria_calzado/index.php');
            }
          break;
          case 'edit':
            $categoria_calzado->validatePrivilegio('Categoria calzado editar');
            if (isset($_POST['enviar'])) {
              $data = $_POST['data'];
              $idCategoriaCalzado = $_POST['data']['id_categoria_calzado'];
              $cantidad = $categoria_calzado->edit($idCategoriaCalzado, $data);
              if ($cantidad) {
                $categoria_calzado->alert('success', 'bi bi-check-circle-fill', 'CATEGORIA DE CALZADO ACTUALIZADA', 'La categoria de calzado fue actualizada correctamente.');
                $data = $categoria_calzado->get();
                include('views/categoria_calzado/index.php');
              } else {
                $categoria_calzado->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
                $data = $categoria_calzado->get();
                include('views/categoria_calzado/index.php');
              }
            }else {
              $data = $categoria_calzado->get($idCategoriaCalzado);
              include('views/categoria_calzado/form.php');
            }
          break;
          case 'get':
          default:
            $categoria_calzado->validatePrivilegio('Categoria calzado leer');
            $data = $categoria_calzado->get();
            include('views/categoria_calzado/index.php');
          break;
        }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>