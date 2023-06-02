<?php require_once (__DIR__."/controllers/juguete.php"); 
      require_once (__DIR__."/controllers/categoria_juguete.php");
      require_once (__DIR__."/controllers/marca_juguete.php");
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
    <title>CRUD JUGUETE</title>
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
        $idJuguete = (isset($_GET['id'])) ? $_GET['id'] : null;
        $idCategoriaJuguete = (isset($_GET['id_categoria_juguete'])) ? $_GET['id_categoria_juguete'] : null;
        $idMarcaJuguete = (isset($_GET['id_marca_juguete'])) ? $_GET['id_marca_juguete'] : null;
        $idSucursal = (isset($_GET['id_sucursal'])) ? $_GET['id_sucursal'] : null;

        switch ($action) {
          case 'new':
            $juguete->validatePrivilegio('Juguete crear');
            $data_categoria_juguete = $categoria_juguete->get();
            $data_marca_juguete = $marca_juguete->get();
            $data_sucursal = $sucursal->get();
            if (isset($_POST['enviar'])) {
                $data = $_POST['data'];
                $cantidad = $juguete->new($data);
                if ($cantidad) {
                    $juguete->alert('success', 'bi bi-check-circle-fill', 'NUEVO JUGUETE', 'El juguete fue agregado correctamente.');
                    $data = $juguete->get();
                    include('views/juguete/index.php');
                } else {
                    $juguete->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
                    $data = $juguete->get();
                    include('views/juguete/index.php');
                }
            }else {
              include('views/juguete/form.php');
            } 
          break;
          case 'delete':
            $juguete->validatePrivilegio('Juguete eliminar');
            $cantidad = $juguete->delete($idJuguete);
            if ($cantidad) {
              $juguete->alert('success', 'bi bi-check-circle-fill', 'JUGUETE ELIMINADO', 'El juguete fue eliminado correctamente.');
              $data = $juguete->get();
              include('views/juguete/index.php');
            } else {
              $juguete->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
              $data = $juguete->get();
              include('views/juguete/index.php');
            }
          break;
          case 'edit':
            $juguete->validatePrivilegio('Juguete editar');
            $data_categoria_juguete = $categoria_juguete->get();
            $data_marca_juguete = $marca_juguete->get();
            $data_sucursal = $sucursal->get();
            if (isset($_POST['enviar'])) {
              $data = $_POST['data'];
              $idJuguete = $_POST['data']['id_juguete'];
              $cantidad = $juguete->edit($idJuguete, $data);
              if ($cantidad) {
                $juguete->alert('success', 'bi bi-check-circle-fill', 'JUGUETE ACTUALIZADO', 'El juguete fue actualizado correctamente.');
                $data = $juguete->get();
                include('views/juguete/index.php');
              } else {
                $juguete->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
                $data = $juguete->get();
                include('views/juguete/index.php');
              }
            }else {
              $data = $juguete->get($idJuguete);
              include('views/juguete/form.php');
            }
          break;
          case 'get':
          default:
            $juguete->validatePrivilegio('Juguete leer');
            $data = $juguete->get();
            include('views/juguete/index.php');
          break;
        }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>