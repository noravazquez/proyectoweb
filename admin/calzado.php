<?php require_once (__DIR__."/controllers/calzado.php"); 
      require_once (__DIR__."/controllers/categoria_calzado.php");
      require_once (__DIR__."/controllers/marca_calzado.php");
      require_once (__DIR__."/controllers/talla_calzado.php");
      require_once (__DIR__."/controllers/sucursal.php");?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD CALZADO</title>
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
        $idCalzado = (isset($_GET['id'])) ? $_GET['id'] : null;
        $idCategoriaCalzado = (isset($_GET['id_categoria_calzado'])) ? $_GET['id_categoria_calzado'] : null;
        $idMarcaCalzado = (isset($_GET['id_marca_calzado'])) ? $_GET['id_marca_calzado'] : null;
        $idTallaCalzado = (isset($_GET['id_talla_calzado'])) ? $_GET['id_talla_calzado'] : null;
        $idSucursal = (isset($_GET['id_sucursal'])) ? $_GET['id_sucursal'] : null;

        switch ($action) {
          case 'new':
            $calzado->validatePrivilegio('Calzado crear');
            $data_categoria_calzado = $categoria_calzado->get();
            $data_marca_calzado = $marca_calzado->get();
            $data_talla_calzado = $talla_calzado->get();
            $data_sucursal = $sucursal->get();
            if (isset($_POST['enviar'])) {
                $data = $_POST['data'];
                $cantidad = $calzado->new($data);
                if ($cantidad) {
                    $calzado->alert('success', 'bi bi-check-circle-fill', 'NUEVO CALZADO', 'El calzado fue agregado correctamente.');
                    $data = $calzado->get();
                    include('views/calzado/index.php');
                } else {
                    $calzado->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
                    $data = $calzado->get();
                    include('views/calzado/index.php');
                }
            }else {
              include('views/calzado/form.php');
            } 
          break;
          case 'delete':
            $calzado->validatePrivilegio('Calzado eliminar');
            $cantidad = $calzado->delete($idCalzado);
            if ($cantidad) {
              $calzado->alert('success', 'bi bi-check-circle-fill', 'CALZADO ELIMINADO', 'El calzado fue eliminado correctamente.');
              $data = $calzado->get();
              include('views/calzado/index.php');
            } else {
              $calzado->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
              $data = $calzado->get();
              include('views/calzado/index.php');
            }
          break;
          case 'edit':
            $calzado->validatePrivilegio('Calzado editar');
            $data_categoria_calzado = $categoria_calzado->get();
            $data_marca_calzado = $marca_calzado->get();
            $data_talla_calzado = $talla_calzado->get();
            $data_sucursal = $sucursal->get();
            if (isset($_POST['enviar'])) {
              $data = $_POST['data'];
              $idCalzado = $_POST['data']['id_calzado'];
              $cantidad = $calzado->edit($idCalzado, $data);
              if ($cantidad) {
                $calzado->alert('success', 'bi bi-check-circle-fill', 'CALZADO ACTUALIZADO', 'El calzado fue actualizado correctamente.');
                $data = $calzado->get();
                include('views/calzado/index.php');
              } else {
                $calzado->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
                $data = $calzado->get();
                include('views/calzado/index.php');
              }
            }else {
              $data = $calzado->get($idCalzado);
              include('views/calzado/form.php');
            }
          break;
          case 'get':
          default:
            $calzado->validatePrivilegio('Calzado leer');
            $data = $calzado->get();
            include('views/calzado/index.php');
          break;
        }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>