<?php require_once (__DIR__."/controllers/privilegio.php");?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD PRIVILEGIO</title>
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
        $idPrivilegio = (isset($_GET['id'])) ? $_GET['id'] : null;

        switch ($action) {
          case 'new':
            $privilegio->validatePrivilegio('Privilegio crear');
            if (isset($_POST['enviar'])) {
              $data = $_POST['data'];
              $cantidad = $privilegio->new($data);
              if ($cantidad) {
                $privilegio->alert('success', 'bi bi-check-circle-fill', 'NUEVO PRIVILEGIO', 'El privilegio fue agregado correctamente.');
                $data = $privilegio->get();
                include('views/privilegio/index.php');
              } else {
                $privilegio->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
                $data = $privilegio->get();
                include('views/privilegio/index.php');
              }
            }else {
              include('views/privilegio/form.php');
            } 
          break;
          case 'delete':
            $privilegio->validatePrivilegio('Privilegio eliminar');
            $cantidad = $privilegio->delete($idPrivilegio);
            if ($cantidad) {
              $privilegio->alert('success', 'bi bi-check-circle-fill', 'PRIVILEGIO ELIMINADO', 'El privilegio fue eliminado correctamente.');
              $data = $privilegio->get();
              include('views/privilegio/index.php');
            } else {
              $privilegio->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
              $data = $privilegio->get();
              include('views/privilegio/index.php');
            }
          break;
          case 'edit':
            $privilegio->validatePrivilegio('Privilegio editar');
            if (isset($_POST['enviar'])) {
              $data = $_POST['data'];
              $idPrivilegio = $_POST['data']['id_privilegio'];
              $cantidad = $privilegio->edit($idPrivilegio, $data);
              if ($cantidad) {
                $privilegio->alert('success', 'bi bi-check-circle-fill', 'PRIVILEGIO ACTUALIZADO', 'El privilegio fue actualizado correctamente.');
                $data = $privilegio->get();
                include('views/privilegio/index.php');
              } else {
                $privilegio->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
                $data = $privilegio->get();
                include('views/privilegio/index.php');
              }
            }else {
              $data = $privilegio->get($idPrivilegio);
              include('views/privilegio/form.php');
            }
          break;
          case 'get':
          default:
            $privilegio->validatePrivilegio('Privilegio leer');
            $data = $privilegio->get();
            include('views/privilegio/index.php');
          break;
        }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>