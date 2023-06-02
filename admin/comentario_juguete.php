<?php require_once (__DIR__."/controllers/comentario_juguete.php"); 
      require_once (__DIR__."/controllers/juguete.php");
      require_once (__DIR__."/controllers/cliente.php");
      require_once (__DIR__."/controllers/usuario.php");?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD COMENTARIO JUGUETE</title>
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
        $idComentarioJuguete = (isset($_GET['id'])) ? $_GET['id'] : null;
        $idJuguete = (isset($_GET['id_juguete'])) ? $_GET['id_juguete'] : null;
        $idCliente = (isset($_GET['id_cliente'])) ? $_GET['id_cliente'] : null;
        $idUsuario = (isset($_GET['id_usuario'])) ? $_GET['id_usuario'] : null;

        switch ($action) {
          case 'new':
            $comentario_juguete->validatePrivilegio('Comentario juguete crear');
            $data_cliente = $cliente->get();
            $data_juguete = $juguete->get();
            $data_usuario = $usuario->get();
            if (isset($_POST['enviar'])) {
                $data = $_POST['data'];
                $cantidad = $comentario_juguete->new($data);
                if ($cantidad) {
                    $comentario_juguete->alert('success', 'bi bi-check-circle-fill', 'NUEVO COMENTARIO JUGUETE', 'El comentario del juguete fue agregado correctamente.');
                    $data = $comentario_juguete->get();
                    include('views/comentario_juguete/index.php');
                } else {
                    $comentario_juguete->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
                    $data = $comentario_juguete->get();
                    include('views/comentario_juguete/index.php');
                }
            }else {
              include('views/comentario_juguete/form.php');
            } 
          break;
          case 'delete':
            $comentario_juguete->validatePrivilegio('Comentario juguete eliminar');
            $cantidad = $comentario_juguete->delete($idComentarioJuguete);
            if ($cantidad) {
              $comentario_juguete->alert('success', 'bi bi-check-circle-fill', 'COMENTARIO DEL JUGUETE ELIMINADO', 'El comentario del juguete fue eliminado correctamente.');
              $data = $comentario_juguete->get();
              include('views/comentario_juguete/index.php');
            } else {
              $comentario_juguete->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
              $data = $comentario_juguete->get();
              include('views/comentario_juguete/index.php');
            }
          break;
          case 'edit':
            $comentario_juguete->validatePrivilegio('Comentario juguete editar');
            $data_cliente = $cliente->get();
            $data_juguete = $juguete->get();
            $data_usuario = $usuario->get();
            if (isset($_POST['enviar'])) {
              $data = $_POST['data'];
              $idComentarioJuguete = $_POST['data']['id_comentario_juguete'];
              $cantidad = $comentario_juguete->edit($idComentarioJuguete, $data);
              if ($cantidad) {
                $comentario_juguete->alert('success', 'bi bi-check-circle-fill', 'COMENTARIO DEL JUGUETE ACTUALIZADO', 'El comentario del juguete fue actualizado correctamente.');
                $data = $comentario_juguete->get();
                include('views/comentario_juguete/index.php');
              } else {
                $comentario_juguete->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
                $data = $comentario_juguete->get();
                include('views/comentario_juguete/index.php');
              }
            }else {
              $data = $comentario_juguete->get($idComentarioJuguete);
              include('views/comentario_juguete/form.php');
            }
          break;
          case 'get':
          default:
            $comentario_juguete->validatePrivilegio('Comentario juguete leer');
              $data = $comentario_juguete->get();
              include('views/comentario_juguete/index.php');
          break;
        }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>