<?php require_once (__DIR__."/controllers/marca_calzado.php"); 
      require_once (__DIR__."/controllers/proveedor.php"); 
      include_once(__DIR__."/controllers/sistema.php"); 
      $sistema->validateRol('Administrador');
      $sistema->validateRol('Gerente');?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD MARCAS DE CALZADO</title>
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
        $idMarcaCalzado = (isset($_GET['id'])) ? $_GET['id'] : null;
        $idProveedor = (isset($_GET['id_proveedor'])) ? $_GET['id_proveedor'] : null;

        switch ($action) {
          case 'new':
            $marca_calzado->validatePrivilegio('Marca calzado crear');
            $data_proveedor = $proveedor->get();
            if (isset($_POST['enviar'])) {
              $data = $_POST['data'];
              $cantidad = $marca_calzado->new($data);
              if ($cantidad) {
                $marca_calzado->alert('success', 'bi bi-check-circle-fill', 'NUEVA MARCA DE CALZADO', 'La marca de calzado fue agregada correctamente.');
                $data = $marca_calzado->get();
                include('views/marca_calzado/index.php');
              } else {
                $marca_calzado->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
                $data = $marca_calzado->get();
                include('views/marca_calzado/index.php');
              }
            }else {
              include('views/marca_calzado/form.php');
            } 
          break;
          case 'delete':
            $marca_calzado->validatePrivilegio('Marca calzado eliminar');
            $cantidad = $marca_calzado->delete($idMarcaCalzado);
            if ($cantidad) {
              $marca_calzado->alert('success', 'bi bi-check-circle-fill', 'MARCA DE CALZADO ELIMINADA', 'La marca de calzado fue eliminada correctamente.');
              $data = $marca_calzado->get();
              include('views/marca_calzado/index.php');
            } else {
              $marca_calzado->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
              $data = $marca_calzado->get();
              include('views/marca_calzado/index.php');
            }
          break;
          case 'edit':
            $marca_calzado->validatePrivilegio('Marca calzado editar');
            $data_proveedor = $proveedor->get();
            if (isset($_POST['enviar'])) {
              $data = $_POST['data'];
              $idMarcaCalzado = $_POST['data']['id_marca_calzado'];
              $cantidad = $marca_calzado->edit($idMarcaCalzado, $data);
              if ($cantidad) {
                $marca_calzado->alert('success', 'bi bi-check-circle-fill', 'MARCA DE CALZADO ACTUALIZADA', 'La marca de calzado fue actualizada correctamente.');
                $data = $marca_calzado->get();
                include('views/marca_calzado/index.php');
              } else {
                $marca_calzado->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
                $data = $marca_calzado->get();
                include('views/marca_calzado/index.php');
              }
            }else {
              $data = $marca_calzado->get($idMarcaCalzado);
              include('views/marca_calzado/form.php');
            }
          break;
          case 'get':
          default:
            $marca_calzado->validatePrivilegio('Marca calzado leer');
            $data = $marca_calzado->get();
            include('views/marca_calzado/index.php');
          break;
        }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>