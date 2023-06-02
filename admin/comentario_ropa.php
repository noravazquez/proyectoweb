<?php require_once (__DIR__."/controllers/comentario_ropa.php"); 
      require_once (__DIR__."/controllers/ropa.php");
      require_once (__DIR__."/controllers/cliente.php");
      require_once (__DIR__."/controllers/usuario.php");?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD COMENTARIO ROPA</title>
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
        }else if (in_array('Usuario', $_SESSION['roles'])) {
          include_once('views/menu_usuario.php');
        }
        $action = (isset($_GET['action'])) ? $_GET['action'] : 'get';
        $idComentarioRopa = (isset($_GET['id'])) ? $_GET['id'] : null;
        $idRopa = (isset($_GET['id_ropa'])) ? $_GET['id_ropa'] : null;
        $idCliente = (isset($_GET['id_cliente'])) ? $_GET['id_cliente'] : null;
        $idUsuario = (isset($_GET['id_usuario'])) ? $_GET['id_usuario'] : null;

        switch ($action) {
          case 'new':
            $comentario_ropa->validatePrivilegio('Comentario ropa crear');
            $data_cliente = $cliente->get();
            $data_ropa = $ropa->get();
            $data_usuario = $usuario->get();
            if (isset($_POST['enviar'])) {
                $data = $_POST['data'];
                $cantidad = $comentario_ropa->new($data);
                if ($cantidad) {
                    $comentario_ropa->alert('success', 'bi bi-check-circle-fill', 'NUEVO COMENTARIO DE ROPA', 'El comentario de la ropa fue agregado correctamente.');
                    $data = $comentario_ropa->get();
                    include('views/comentario_ropa/index.php');
                } else {
                    $comentario_ropa->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
                    $data = $comentario_ropa->get();
                    include('views/comentario_ropa/index.php');
                }
            }else {
              include('views/comentario_ropa/form.php');
            } 
          break;
          case 'delete':
            $comentario_ropa->validatePrivilegio('Comentario ropa eliminar');
            $cantidad = $comentario_ropa->delete($idComentarioRopa);
            if ($cantidad) {
              $comentario_ropa->alert('success', 'bi bi-check-circle-fill', 'COMENTARIO DE LA ROPA ELIMINADO', 'El comentario de la ropa fue eliminado correctamente.');
              $data = $comentario_ropa->get();
              include('views/comentario_ropa/index.php');
            } else {
              $comentario_ropa->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
              $data = $comentario_ropa->get();
              include('views/comentario_ropa/index.php');
            }
          break;
          case 'edit':
            $comentario_ropa->validatePrivilegio('Comentario ropa editar');
            $data_cliente = $cliente->get();
            $data_ropa = $ropa->get();
            $data_usuario = $usuario->get();
            if (isset($_POST['enviar'])) {
              $data = $_POST['data'];
              $idComentarioRopa = $_POST['data']['id_comentario_ropa'];
              $cantidad = $comentario_ropa->edit($idComentarioRopa, $data);
              if ($cantidad) {
                $comentario_ropa->alert('success', 'bi bi-check-circle-fill', 'COMENTARIO DE LA ROPA ACTUALIZADO', 'El comentario de la ropa fue actualizado correctamente.');
                $data = $comentario_ropa->get();
                include('views/comentario_ropa/index.php');
              } else {
                $comentario_ropa->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
                $data = $comentario_ropa->get();
                include('views/comentario_ropa/index.php');
              }
            }else {
              $data = $comentario_ropa->get($idComentarioRopa);
              include('views/comentario_ropa/form.php');
            }
          break;
          case 'get':
          default:
            $comentario_ropa->validatePrivilegio('Comentario ropa leer');
              $data = $comentario_ropa->get();
              include('views/comentario_ropa/index.php');
          break;
        }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>