<?php require_once (__DIR__."/controllers/proveedor.php");?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD PROVEEDOR</title>
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
        $idProveedor = (isset($_GET['id'])) ? $_GET['id'] : null;

        switch ($action) {
          case 'new':
            $proveedor->validatePrivilegio('Proveedor crear');
            if (isset($_POST['enviar'])) {
              $data = $_POST['data'];
              $cantidad = $proveedor->new($data);
              if ($cantidad) {
                $proveedor->alert('success', 'bi bi-check-circle-fill', 'NUEVO PROVEEDOR', 'El proveedor fue agregado correctamente.');
                $data = $proveedor->get();
                include('views/proveedor/index.php');
              } else {
                $proveedor->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
                $data = $proveedor->get();
                include('views/proveedor/index.php');
              }
            }else {
              include('views/proveedor/form.php');
            } 
          break;
          case 'delete':
            $proveedor->validatePrivilegio('Proveedor eliminar');
            $cantidad = $proveedor->delete($idProveedor);
            if ($cantidad) {
              $proveedor->alert('success', 'bi bi-check-circle-fill', 'PROVEEDOR ELIMINADO', 'El proveedor fue eliminado correctamente.');
              $data = $proveedor->get();
              include('views/proveedor/index.php');
            } else {
              $proveedor->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
              $data = $proveedor->get();
              include('views/proveedor/index.php');
            }
          break;
          case 'edit':
            $proveedor->validatePrivilegio('Proveedor editar');
            if (isset($_POST['enviar'])) {
              $data = $_POST['data'];
              $idProveedor = $_POST['data']['id_proveedor'];
              $cantidad = $proveedor->edit($idProveedor, $data);
              if ($cantidad) {
                $proveedor->alert('success', 'bi bi-check-circle-fill', 'PROVEEDOR ACTUALIZADO', 'El proveedor fue actualizado correctamente.');
                $data = $proveedor->get();
                include('views/proveedor/index.php');
              } else {
                $proveedor->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
                $data = $proveedor->get();
                include('views/proveedor/index.php');
              }
            }else {
              $data = $proveedor->get($idProveedor);
              include('views/proveedor/form.php');
            }
          break;
          case 'get':
          default:
            $proveedor->validatePrivilegio('Proveedor leer');
            $data = $proveedor->get();
            include('views/proveedor/index.php');
          break;
        }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>