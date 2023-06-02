<?php require_once (__DIR__."/controllers/marca_juguete.php"); 
      require_once (__DIR__."/controllers/proveedor.php"); ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD MARCAS DE JUGUETES</title>
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
        $idMarcaJuguete = (isset($_GET['id'])) ? $_GET['id'] : null;
        $idProveedor = (isset($_GET['id_proveedor'])) ? $_GET['id_proveedor'] : null;

        switch ($action) {
          case 'new':
            $marca_juguete->validatePrivilegio('Marca juguete crear');
            $data_proveedor = $proveedor->get();
            if (isset($_POST['enviar'])) {
              $data = $_POST['data'];
              $cantidad = $marca_juguete->new($data);
              if ($cantidad) {
                $marca_juguete->alert('success', 'bi bi-check-circle-fill', 'NUEVA MARCA DE JUGUETE', 'La marca de juguete fue agregada correctamente.');
                $data = $marca_juguete->get();
                include('views/marca_juguete/index.php');
              } else {
                $marca_juguete->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
                $data = $marca_juguete->get();
                include('views/marca_juguete/index.php');
              }
            }else {
              include('views/marca_juguete/form.php');
            } 
          break;
          case 'delete':
            $marca_juguete->validatePrivilegio('Marca juguete eliminar');
            $cantidad = $marca_juguete->delete($idMarcaJuguete);
            if ($cantidad) {
              $marca_juguete->alert('success', 'bi bi-check-circle-fill', 'MARCA DE JUGUETE ELIMINADA', 'La marca de juguete fue eliminada correctamente.');
              $data = $marca_juguete->get();
              include('views/marca_juguete/index.php');
            } else {
              $marca_juguete->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
              $data = $marca_juguete->get();
              include('views/marca_juguete/index.php');
            }
          break;
          case 'edit':
            $marca_juguete->validatePrivilegio('Marca juguete editar');
            $data_proveedor = $proveedor->get();
            if (isset($_POST['enviar'])) {
              $data = $_POST['data'];
              $idMarcaJuguete = $_POST['data']['id_marca_juguete'];
              $cantidad = $marca_juguete->edit($idMarcaJuguete, $data);
              if ($cantidad) {
                $marca_juguete->alert('success', 'bi bi-check-circle-fill', 'MARCA DE JUGUETE ACTUALIZADA', 'La marca de juguete fue actualizada correctamente.');
                $data = $marca_juguete->get();
                include('views/marca_juguete/index.php');
              } else {
                $marca_juguete->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
                $data = $marca_juguete->get();
                include('views/marca_juguete/index.php');
              }
            }else {
              $data = $marca_juguete->get($idMarcaJuguete);
              include('views/marca_juguete/form.php');
            }
          break;
          case 'get':
          default:
            $marca_juguete->validatePrivilegio('Marca juguete leer');
            $data = $marca_juguete->get();
            include('views/marca_juguete/index.php');
          break;
        }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>