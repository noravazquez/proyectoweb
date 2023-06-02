<?php require_once (__DIR__."/controllers/talla_ropa.php");
      include_once(__DIR__."/controllers/sistema.php"); 
      $sistema->validateRol('Administrador');?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD TALLAS DE ROPA</title>
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
        $idTallaRopa = (isset($_GET['id'])) ? $_GET['id'] : null;

        switch ($action) {
          case 'new':
            $talla_ropa->validatePrivilegio('Talla ropa crear');
            if (isset($_POST['enviar'])) {
              $data = $_POST['data'];
              $cantidad = $talla_ropa->new($data);
              if ($cantidad) {
                $talla_ropa->alert('success', 'bi bi-check-circle-fill', 'NUEVA TALLA DE ROPA', 'La talla de ropa fue agregada correctamente.');
                $data = $talla_ropa->get();
                include('views/talla_ropa/index.php');
              } else {
                $talla_ropa->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
                $data = $talla_ropa->get();
                include('views/talla_ropa/index.php');
              }
            }else {
              include('views/talla_ropa/form.php');
            } 
          break;
          case 'delete':
            $talla_ropa->validatePrivilegio('Talla ropa eliminar');
            $cantidad = $talla_ropa->delete($idTallaRopa);
            if ($cantidad) {
              $talla_ropa->alert('success', 'bi bi-check-circle-fill', 'TALLA DE ROPA ELIMINADA', 'La talla de ropa fue eliminada correctamente.');
              $data = $talla_ropa->get();
              include('views/talla_ropa/index.php');
            } else {
              $talla_ropa->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
              $data = $talla_ropa->get();
              include('views/talla_ropa/index.php');
            }
          break;
          case 'edit':
            $talla_ropa->validatePrivilegio('Talla ropa editar');
            if (isset($_POST['enviar'])) {
              $data = $_POST['data'];
              $idTallaRopa = $_POST['data']['id_talla_ropa'];
              $cantidad = $talla_ropa->edit($idTallaRopa, $data);
              if ($cantidad) {
                $talla_ropa->alert('success', 'bi bi-check-circle-fill', 'TALLA DE ROPA ACTUALIZADA', 'La talla de ropa fue actualizada correctamente.');
                $data = $talla_ropa->get();
                include('views/talla_ropa/index.php');
              } else {
                $talla_ropa->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
                $data = $talla_ropa->get();
                include('views/talla_ropa/index.php');
              }
            }else {
              $data = $talla_ropa->get($idTallaRopa);
              include('views/talla_ropa/form.php');
            }
          break;
          case 'get':
          default:
            $talla_ropa->validatePrivilegio('Talla ropa leer');
            $data = $talla_ropa->get();
            include('views/talla_ropa/index.php');
          break;
        }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>