<?php require_once (__DIR__."/controllers/ropa.php"); 
      require_once (__DIR__."/controllers/categoria_ropa.php");
      require_once (__DIR__."/controllers/marca_ropa.php");
      require_once (__DIR__."/controllers/talla_ropa.php");
      require_once (__DIR__."/controllers/sucursal.php");
      include_once(__DIR__."/controllers/sistema.php"); 
      $sistema->validateRol('Administrador');
      $sistema->validateRol('Gerente');
      $sistema->validateRol('Dependiente');?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD ROPA</title>
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
        $idRopa = (isset($_GET['id'])) ? $_GET['id'] : null;
        $idCategoriaRopa = (isset($_GET['id_categoria_ropa'])) ? $_GET['id_categoria_ropa'] : null;
        $idMarcaRopa = (isset($_GET['id_marca_ropa'])) ? $_GET['id_marca_ropa'] : null;
        $idTallaRopa = (isset($_GET['id_talla_ropa'])) ? $_GET['id_talla_ropa'] : null;
        $idSucursal = (isset($_GET['id_sucursal'])) ? $_GET['id_sucursal'] : null;

        switch ($action) {
          case 'new':
            $ropa->validatePrivilegio('Ropa crear');
            $data_categoria_ropa = $categoria_ropa->get();
            $data_marca_ropa = $marca_ropa->get();
            $data_talla_ropa = $talla_ropa->get();
            $data_sucursal = $sucursal->get();
            if (isset($_POST['enviar'])) {
                $data = $_POST['data'];
                $cantidad = $ropa->new($data);
                if ($cantidad) {
                    $ropa->alert('success', 'bi bi-check-circle-fill', 'NUEVA ROPA', 'La ropa fue agregada correctamente.');
                    $data = $ropa->get();
                    include('views/ropa/index.php');
                } else {
                    $ropa->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
                    $data = $ropa->get();
                    include('views/ropa/index.php');
                }
            }else {
              include('views/ropa/form.php');
            } 
          break;
          case 'delete':
            $ropa->validatePrivilegio('Ropa eliminar');
            $cantidad = $ropa->delete($idRopa);
            if ($cantidad) {
              $ropa->alert('success', 'bi bi-check-circle-fill', 'ROPA ELIMINADA', 'La ropa fue eliminada correctamente.');
              $data = $ropa->get();
              include('views/ropa/index.php');
            } else {
              $ropa->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
              $data = $ropa->get();
              include('views/ropa/index.php');
            }
          break;
          case 'edit':
            $ropa->validatePrivilegio('Ropa editar');
            $data_categoria_ropa = $categoria_ropa->get();
            $data_marca_ropa = $marca_ropa->get();
            $data_talla_ropa = $talla_ropa->get();
            $data_sucursal = $sucursal->get();
            if (isset($_POST['enviar'])) {
              $data = $_POST['data'];
              $idRopa = $_POST['data']['id_ropa'];
              $cantidad = $ropa->edit($idRopa, $data);
              if ($cantidad) {
                $ropa->alert('success', 'bi bi-check-circle-fill', 'ROPA ACTUALIZADA', 'La ropa fue actualizada correctamente.');
                $data = $ropa->get();
                include('views/ropa/index.php');
              } else {
                $ropa->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
                $data = $ropa->get();
                include('views/ropa/index.php');
              }
            }else {
              $data = $ropa->get($idRopa);
              include('views/ropa/form.php');
            }
          break;
          case 'get':
          default:
            $ropa->validatePrivilegio('Ropa leer');
            $data = $ropa->get();
            include('views/ropa/index.php');
          break;
        }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>