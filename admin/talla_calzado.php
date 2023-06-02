<?php require_once (__DIR__."/controllers/talla_calzado.php");
      include_once(__DIR__."/controllers/sistema.php"); 
      $sistema->validateRol('Administrador');
      $sistema->validateRol('Gerente');
      $sistema->validateRol('Dependiente');?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD TALLAS DE CALZADO</title>
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
        $idTallaCalzado = (isset($_GET['id'])) ? $_GET['id'] : null;

        switch ($action) {
          case 'new':
            $talla_calzado->validatePrivilegio('Talla calzado crear');
            if (isset($_POST['enviar'])) {
              $data = $_POST['data'];
              $cantidad = $talla_calzado->new($data);
              if ($cantidad) {
                $talla_calzado->alert('success', 'bi bi-check-circle-fill', 'NUEVA TALLA DE CALZADO', 'La talla de calzado fue agregada correctamente.');
                $data = $talla_calzado->get();
                include('views/talla_calzado/index.php');
              } else {
                $talla_calzado->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
                $data = $talla_calzado->get();
                include('views/talla_calzado/index.php');
              }
            }else {
              include('views/talla_calzado/form.php');
            } 
          break;
          case 'delete':
            $talla_calzado->validatePrivilegio('Talla calzado eliminar');
            $cantidad = $talla_calzado->delete($idTallaCalzado);
            if ($cantidad) {
              $talla_calzado->alert('success', 'bi bi-check-circle-fill', 'TALLA DE CALZADO ELIMINADA', 'La talla de calzado fue eliminada correctamente.');
              $data = $talla_calzado->get();
              include('views/talla_calzado/index.php');
            } else {
              $talla_calzado->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
              $data = $talla_calzado->get();
              include('views/talla_calzado/index.php');
            }
          break;
          case 'edit':
            $talla_calzado->validatePrivilegio('Talla calzado editar');
            if (isset($_POST['enviar'])) {
              $data = $_POST['data'];
              $idTallaCalzado = $_POST['data']['id_talla_calzado'];
              $cantidad = $talla_calzado->edit($idTallaCalzado, $data);
              if ($cantidad) {
                $talla_calzado->alert('success', 'bi bi-check-circle-fill', 'TALLA DE CALZADO ACTUALIZADA', 'La talla de calzado fue actualizada correctamente.');
                $data = $talla_calzado->get();
                include('views/talla_calzado/index.php');
              } else {
                $talla_calzado->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
                $data = $talla_calzado->get();
                include('views/talla_calzado/index.php');
              }
            }else {
              $data = $talla_calzado->get($idTallaCalzado);
              include('views/talla_calzado/form.php');
            }
          break;
          case 'get':
          default:
            $talla_calzado->validatePrivilegio('Talla calzado leer');
            $data = $talla_calzado->get();
            include('views/talla_calzado/index.php');
          break;
        }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>