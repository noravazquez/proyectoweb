<?php require_once (__DIR__."/controllers/pago.php"); 
      require_once (__DIR__."/controllers/pedido.php");
      require_once (__DIR__."/controllers/metodo_pago.php"); 
      include_once(__DIR__."/controllers/sistema.php"); 
      $sistema->validateRol('Administrador');
      $sistema->validateRol('Gerente');
      $sistema->validateRol('Dependiente');?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD PAGOS</title>
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
        $idMetodoPago = (isset($_GET['id_metodo_pago'])) ? $_GET['id_metodo_pago'] : null;

        switch ($action) {
          case 'new':
            $pago->validatePrivilegio('Pago crear');
            $data_pedido = $pedido->get();
            $data_metodo_pago = $metodo_pago->get();
            if (isset($_POST['enviar'])) {
              $data = $_POST['data'];
              $cantidad = $pago->new($data);
              if ($cantidad) {
                $pago->alert('success', 'bi bi-check-circle-fill', 'NUEVO PAGO', 'El pago fue agregado correctamente.');
                $data = $pago->get();
                include('views/pago/index.php');
              } else {
                $pago->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
                $data = $pago->get();
                include('views/pago/index.php');
              }
            }else {
              include('views/pago/form.php');
            } 
          break;
          case 'delete':
            $pago->validatePrivilegio('Pago eliminar');
            $cantidad = $pago->delete($idPedido, $idMetodoPago);
            if ($cantidad) {
              $pago->alert('success', 'bi bi-check-circle-fill', 'PAGO ELIMINADO', 'El pago fue eliminado correctamente.');
              $data = $pago->get();
              include('views/pago/index.php');
            } else {
              $pago->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
              $data = $pago->get();
              include('views/pago/index.php');
            }
          break;
          case 'edit':
            $pago->validatePrivilegio('Pago editar');
            $data_pedido = $pedido->get();
            $data_metodo_pago = $metodo_pago->get();
            if (isset($_POST['enviar'])) {
              $data = $_POST['data'];
              $idPedido = $_POST['data']['id_pedido_actual'];
              $idMetodoPago = $_POST['data']['id_metodo_pago_actual'];
              $cantidad = $pago->edit($idPedido, $idMetodoPago, $data);
              if ($cantidad) {
                $pago->alert('success', 'bi bi-check-circle-fill', 'PAGO ACTUALIZADO', 'El pago fue actualizado correctamente.');
                $data = $pago->get();
                include('views/pago/index.php');
              } else {
                $pago->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
                $data = $pago->get();
                include('views/pago/index.php');
              }
            }else {
              $data = $pago->get($idPedido, $idMetodoPago);
              include('views/pago/form.php');
            }
          break;
          case 'get':
          default:
            $pago->validatePrivilegio('Pago leer');
            $data = $pago->get();
            include('views/pago/index.php');
          break;
        }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>