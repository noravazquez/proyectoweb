<?php require_once (__DIR__."/controllers/detalle_pedido_ropa.php"); 
      require_once (__DIR__."/controllers/pedido.php");
      require_once (__DIR__."/controllers/ropa.php"); 
      include_once(__DIR__."/controllers/sistema.php"); 
      $sistema->validateRol('Administrador');?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD DETALLES DE PEDIDOS DE ROPA</title>
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
        $idPedido = (isset($_GET['id_pedido'])) ? $_GET['id_pedido'] : null;
        $idRopa = (isset($_GET['id_ropa'])) ? $_GET['id_ropa'] : null;

        switch ($action) {
          case 'new':
            $detalle_pedido_ropa->validatePrivilegio('Detalle ropa crear');
            $data_pedido = $pedido->get();
            $data_ropa = $ropa->get();
            if (isset($_POST['enviar'])) {
              $data = $_POST['data'];
              $cantidad = $detalle_pedido_ropa->new($data);
              if ($cantidad) {
                $detalle_pedido_ropa->alert('success', 'bi bi-check-circle-fill', 'NUEVO DETALLE PEDIDO DE ROPA', 'El detalle de pedido de ropa fue agregado correctamente.');
                $data = $detalle_pedido_ropa->get();
                include('views/detalle_pedido_ropa/index.php');
              } else {
                $detalle_pedido_ropa->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
                $data = $detalle_pedido_ropa->get();
                include('views/detalle_pedido_ropa/index.php');
              }
            }else {
              include('views/detalle_pedido_ropa/form.php');
            } 
          break;
          case 'delete':
            $detalle_pedido_ropa->validatePrivilegio('Detalle ropa eliminar');
            $cantidad = $detalle_pedido_ropa->delete($idPedido, $idRopa);
            if ($cantidad) {
              $detalle_pedido_ropa->alert('success', 'bi bi-check-circle-fill', 'DETALLE PEDIDO DE ROPA ELIMINADO', 'El detalle pedido de ropa fue eliminado correctamente.');
              $data = $detalle_pedido_ropa->get();
              include('views/detalle_pedido_ropa/index.php');
            } else {
              $detalle_pedido_ropa->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
              $data = $detalle_pedido_ropa->get();
              include('views/detalle_pedido_ropa/index.php');
            }
          break;
          case 'edit':
            $detalle_pedido_ropa->validatePrivilegio('Detalle ropa editar');
            $data_pedido = $pedido->get();
            $data_ropa = $ropa->get();
            if (isset($_POST['enviar'])) {
              $data = $_POST['data'];
              $idPedido = $_POST['data']['id_pedido_actual'];
              $idRopa = $_POST['data']['id_ropa_actual'];
              $cantidad = $detalle_pedido_ropa->edit($idPedido, $idRopa, $data);
              if ($cantidad) {
                $detalle_pedido_ropa->alert('success', 'bi bi-check-circle-fill', 'DETALLE PEDIDO DE ROPA ACTUALIZADO', 'El detalle pedido de ropa fue actualizado correctamente.');
                $data = $detalle_pedido_ropa->get();
                include('views/detalle_pedido_ropa/index.php');
              } else {
                $detalle_pedido_ropa->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
                $data = $detalle_pedido_ropa->get();
                include('views/detalle_pedido_ropa/index.php');
              }
            }else {
              $data = $detalle_pedido_ropa->get($idPedido, $idRopa);
              include('views/detalle_pedido_ropa/form.php');
            }
          break;
          case 'get':
          default:
            $detalle_pedido_ropa->validatePrivilegio('Detalle ropa leer');
            $data = $detalle_pedido_ropa->get();
            include('views/detalle_pedido_ropa/index.php');
          break;
        }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>