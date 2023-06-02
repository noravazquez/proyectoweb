<?php require_once (__DIR__."/controllers/detalle_pedido_calzado.php"); 
      require_once (__DIR__."/controllers/pedido.php");
      require_once (__DIR__."/controllers/calzado.php"); ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD DETALLES DE PEDIDOS DE CALZADO</title>
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
        $idCalzado = (isset($_GET['id_calzado'])) ? $_GET['id_calzado'] : null;

        switch ($action) {
          case 'new':
            $detalle_pedido_calzado->validatePrivilegio('Detalle calzado crear');
            $data_pedido = $pedido->get();
            $data_calzado = $calzado->get();
            if (isset($_POST['enviar'])) {
              $data = $_POST['data'];
              $cantidad = $detalle_pedido_calzado->new($data);
              if ($cantidad) {
                $detalle_pedido_calzado->alert('success', 'bi bi-check-circle-fill', 'NUEVO DETALLE PEDIDO DE CALZADO', 'El detalle de pedido de calzado fue agregado correctamente.');
                $data = $detalle_pedido_calzado->get();
                include('views/detalle_pedido_calzado/index.php');
              } else {
                $detalle_pedido_calzado->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
                $data = $detalle_pedido_calzado->get();
                include('views/detalle_pedido_calzado/index.php');
              }
            }else {
              include('views/detalle_pedido_calzado/form.php');
            } 
          break;
          case 'delete':
            $detalle_pedido_calzado->validatePrivilegio('Detalle calzado eliminar');
            $cantidad = $detalle_pedido_calzado->delete($idPedido, $idCalzado);
            if ($cantidad) {
              $detalle_pedido_calzado->alert('success', 'bi bi-check-circle-fill', 'DETALLE PEDIDO DE CALZADO ELIMINADO', 'El detalle pedido de calzado fue eliminado correctamente.');
              $data = $detalle_pedido_calzado->get();
              include('views/detalle_pedido_calzado/index.php');
            } else {
              $detalle_pedido_calzado->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
              $data = $detalle_pedido_calzado->get();
              include('views/detalle_pedido_calzado/index.php');
            }
          break;
          case 'edit':
            $detalle_pedido_calzado->validatePrivilegio('Detalle calzado editar');
            $data_pedido = $pedido->get();
            $data_calzado = $calzado->get();
            if (isset($_POST['enviar'])) {
              $data = $_POST['data'];
              $idPedido = $_POST['data']['id_pedido_actual'];
              $idCalzado = $_POST['data']['id_calzado_actual'];
              $cantidad = $detalle_pedido_calzado->edit($idPedido, $idCalzado, $data);
              if ($cantidad) {
                $detalle_pedido_calzado->alert('success', 'bi bi-check-circle-fill', 'DETALLE PEDIDO DE CALZADO ACTUALIZADO', 'El detalle pedido de calzado fue actualizado correctamente.');
                $data = $detalle_pedido_calzado->get();
                include('views/detalle_pedido_calzado/index.php');
              } else {
                $detalle_pedido_calzado->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
                $data = $detalle_pedido_calzado->get();
                include('views/detalle_pedido_calzado/index.php');
              }
            }else {
              $data = $detalle_pedido_calzado->get($idPedido, $idCalzado);
              include('views/detalle_pedido_calzado/form.php');
            }
          break;
          case 'get':
          default:
            $detalle_pedido_calzado->validatePrivilegio('Detalle calzado leer');
              $data = $detalle_pedido_calzado->get();
              include('views/detalle_pedido_calzado/index.php');
          break;
        }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>