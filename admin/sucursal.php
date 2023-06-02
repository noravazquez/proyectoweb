<?php require_once (__DIR__."/controllers/sucursal.php");
      include_once(__DIR__."/controllers/sistema.php"); 
      $sistema->validateRol('Administrador');
      $sistema->validateRol('Gerente');?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD SUCURSAL</title>
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
        $idSucursal = (isset($_GET['id'])) ? $_GET['id'] : null;

        switch ($action) {
          case 'new':
            $sucursal->validatePrivilegio('Sucursal crear');
            if (isset($_POST['enviar'])) {
              $data = $_POST['data'];
              $cantidad = $sucursal->new($data);
              if ($cantidad) {
                $sucursal->alert('success', 'bi bi-check-circle-fill', 'NUEVA SUCURSAL', 'La sucursal fue agregada correctamente.');
                $data = $sucursal->get();
                include('views/sucursal/index.php');
              } else {
                $sucursal->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
                $data = $sucursal->get();
                include('views/sucursal/index.php');
              }
            }else {
              include('views/sucursal/form.php');
            } 
          break;
          case 'delete':
            $sucursal->validatePrivilegio('Sucursal eliminar');
            $cantidad = $sucursal->delete($idSucursal);
            if ($cantidad) {
              $sucursal->alert('success', 'bi bi-check-circle-fill', 'SUCURSAL ELIMINADA', 'La sucursal fue eliminada correctamente.');
              $data = $sucursal->get();
              include('views/sucursal/index.php');
            } else {
              $sucursal->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
              $data = $sucursal->get();
              include('views/sucursal/index.php');
            }
          break;
          case 'edit':
            $sucursal->validatePrivilegio('Sucursal editar');
            if (isset($_POST['enviar'])) {
              $data = $_POST['data'];
              $idSucursal = $_POST['data']['id_sucursal'];
              $cantidad = $sucursal->edit($idSucursal, $data);
              if ($cantidad) {
                $sucursal->alert('success', 'bi bi-check-circle-fill', 'SUCURSAL ACTUALIZADA', 'La sucursal fue actualizada correctamente.');
                $data = $sucursal->get();
                include('views/sucursal/index.php');
              } else {
                $sucursal->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
                $data = $sucursal->get();
                include('views/sucursal/index.php');
              }
            }else {
              $data = $sucursal->get($idSucursal);
              include('views/sucursal/form.php');
            }
          break;
          case 'get':
          default:
            $sucursal->validatePrivilegio('Sucursal leer');
            $data = $sucursal->get();
            include('views/sucursal/index.php');
          break;
        }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>