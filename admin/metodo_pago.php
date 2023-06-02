<?php require_once (__DIR__."/controllers/metodo_pago.php");?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD METODO DE PAGO</title>
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
        $idMetodoPago = (isset($_GET['id'])) ? $_GET['id'] : null;

        switch ($action) {
          case 'new':
            $metodo_pago->validatePrivilegio('Metodo pago crear');
            if (isset($_POST['enviar'])) {
              $data = $_POST['data'];
              $cantidad = $metodo_pago->new($data);
              if ($cantidad) {
                $metodo_pago->alert('success', 'bi bi-check-circle-fill', 'NUEVO METODO DE PAGO', 'El metodo de pago fue agregado correctamente.');
                $data = $metodo_pago->get();
                include('views/metodo_pago/index.php');
              } else {
                $metodo_pago->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
                $data = $metodo_pago->get();
                include('views/metodo_pago/index.php');
              }
            }else {
              include('views/metodo_pago/form.php');
            } 
          break;
          case 'delete':
            $metodo_pago->validatePrivilegio('Metodo pago eliminar');
            $cantidad = $metodo_pago->delete($idMetodoPago);
            if ($cantidad) {
              $metodo_pago->alert('success', 'bi bi-check-circle-fill', 'METODO DE PAGO ELIMINADO', 'El metodo de pago fue eliminado correctamente.');
              $data = $metodo_pago->get();
              include('views/metodo_pago/index.php');
            } else {
              $metodo_pago->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
              $data = $metodo_pago->get();
              include('views/metodo_pago/index.php');
            }
          break;
          case 'edit':
            $metodo_pago->validatePrivilegio('Metodo pago editar');
            if (isset($_POST['enviar'])) {
              $data = $_POST['data'];
              $idMetodoPago = $_POST['data']['id_metodo_pago'];
              $cantidad = $metodo_pago->edit($idMetodoPago, $data);
              if ($cantidad) {
                $metodo_pago->alert('success', 'bi bi-check-circle-fill', 'METODO DE PAGO ACTUALIZADO', 'El metodo de pago fue actualizado correctamente.');
                $data = $metodo_pago->get();
                include('views/metodo_pago/index.php');
              } else {
                $metodo_pago->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
                $data = $metodo_pago->get();
                include('views/metodo_pago/index.php');
              }
            }else {
              $data = $metodo_pago->get($idMetodoPago);
              include('views/metodo_pago/form.php');
            }
          break;
          case 'get':
          default:
            $metodo_pago->validatePrivilegio('Metodo pago leer');
            $data = $metodo_pago->get();
            include('views/metodo_pago/index.php');
          break;
        }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>