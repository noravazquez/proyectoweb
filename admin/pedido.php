<?php require_once (__DIR__."/controllers/pedido.php");
      require_once (__DIR__."/controllers/cliente.php");
      include_once(__DIR__."/controllers/sistema.php"); 
      $sistema->validateRol('Administrador');
      $sistema->validateRol('Gerente');?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD PEDIDO</title>
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
        $idPedido = (isset($_GET['id'])) ? $_GET['id'] : null;
        $idCliente = (isset($_GET['id_cliente'])) ? $_GET['id_cliente'] : null;

        switch ($action) {
          case 'new':
            $pedido->validatePrivilegio('Pedido crear');
            $data_cliente = $cliente->get();
            if (isset($_POST['enviar'])) {
              $data = $_POST['data'];
              $cantidad = $pedido->new($data);
              if ($cantidad) {
                $pedido->alert('success', 'bi bi-check-circle-fill', 'NUEVO PEDIDO', 'El pedido fue agregado correctamente.');
                $data = $pedido->get();
                include('views/pedido/index.php');
              } else {
                $pedido->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
                $data = $pedido->get();
                include('views/pedido/index.php');
              }
            }else {
              include('views/pedido/form.php');
            } 
          break;
          case 'delete':
            $pedido->validatePrivilegio('Pedido eliminar');
            $cantidad = $pedido->delete($idPedido);
            if ($cantidad) {
              $pedido->alert('success', 'bi bi-check-circle-fill', 'PEDIDO ELIMINADO', 'El pedido fue eliminado correctamente.');
              $data = $pedido->get();
              include('views/pedido/index.php');
            } else {
              $pedido->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
              $data = $pedido->get();
              include('views/pedido/index.php');
            }
          break;
          case 'edit':
            $pedido->validatePrivilegio('Pedido editar');
            $data_cliente = $cliente->get();
            if (isset($_POST['enviar'])) {
              $data = $_POST['data'];
              $idPedido = $_POST['data']['id_pedido'];
              $cantidad = $pedido->edit($idPedido, $data);
              if ($cantidad) {
                $pedido->alert('success', 'bi bi-check-circle-fill', 'PEDIDO ACTUALIZADO', 'El pedido fue actualizado correctamente.');
                $data = $pedido->get();
                include('views/pedido/index.php');
              } else {
                $pedido->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
                $data = $pedido->get();
                include('views/pedido/index.php');
              }
            }else {
              $data = $pedido->get($idPedido);
              include('views/pedido/form.php');
            }
          break;
          case 'get':
          default:
            $pedido->validatePrivilegio('Pedido leer');
            $data = $pedido->get();
            include('views/pedido/index.php');
          break;
        }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>