<?php require_once (__DIR__."/controllers/comentario_calzado.php"); 
      require_once (__DIR__."/controllers/calzado.php");
      require_once (__DIR__."/controllers/cliente.php");
      require_once (__DIR__."/controllers/usuario.php");?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD COMENTARIO CALZADO</title>
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
        }else if (in_array('Usuario', $_SESSION['roles'])) {
          include_once('views/menu_usuario.php');
        }
        $action = (isset($_GET['action'])) ? $_GET['action'] : 'get';
        $idComentarioCalzado = (isset($_GET['id'])) ? $_GET['id'] : null;
        $idCalzado = (isset($_GET['id_calzado'])) ? $_GET['id_calzado'] : null;
        $idCliente = (isset($_GET['id_cliente'])) ? $_GET['id_cliente'] : null;
        $idUsuario = (isset($_GET['id_usuario'])) ? $_GET['id_usuario'] : null;

        switch ($action) {
          case 'new':
            $comentario_calzado->validatePrivilegio('Comentario calzado crear');
            $data_cliente = $cliente->get();
            $data_calzado = $calzado->get();
            $data_usuario = $usuario->get();
            if (isset($_POST['enviar'])) {
                $data = $_POST['data'];
                $cantidad = $comentario_calzado->new($data);
                if ($cantidad) {
                    $comentario_calzado->alert('success', 'bi bi-check-circle-fill', 'NUEVO COMENTARIO CALZADO', 'El comentario del calzado fue agregado correctamente.');
                    $data = $comentario_calzado->get();
                    include('views/comentario_calzado/index.php');
                } else {
                    $comentario_calzado->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
                    $data = $comentario_calzado->get();
                    include('views/comentario_calzado/index.php');
                }
            }else {
              include('views/comentario_calzado/form.php');
            } 
          break;
          case 'delete':
            $comentario_calzado->validatePrivilegio('Comentario calzado eliminar');
            $cantidad = $comentario_calzado->delete($idComentarioCalzado);
            if ($cantidad) {
              $comentario_calzado->alert('success', 'bi bi-check-circle-fill', 'COMENTARIO DEL CALZADO ELIMINADO', 'El comentario del calzado fue eliminado correctamente.');
              $data = $comentario_calzado->get();
              include('views/comentario_calzado/index.php');
            } else {
              $comentario_calzado->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
              $data = $comentario_calzado->get();
              include('views/comentario_calzado/index.php');
            }
          break;
          case 'edit':
            $comentario_calzado->validatePrivilegio('Comentario calzado editar');
            $data_cliente = $cliente->get();
            $data_calzado = $calzado->get();
            $data_usuario = $usuario->get();
            if (isset($_POST['enviar'])) {
              $data = $_POST['data'];
              $idComentarioCalzado = $_POST['data']['id_comentario_calzado'];
              $cantidad = $comentario_calzado->edit($idComentarioCalzado, $data);
              if ($cantidad) {
                $comentario_calzado->alert('success', 'bi bi-check-circle-fill', 'COMENTARIO DEL CALZADO ACTUALIZADO', 'El comentario del calzado fue actualizado correctamente.');
                $data = $comentario_calzado->get();
                include('views/comentario_calzado/index.php');
              } else {
                $comentario_calzado->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
                $data = $comentario_calzado->get();
                include('views/comentario_calzado/index.php');
              }
            }else {
              $data = $comentario_calzado->get($idComentarioCalzado);
              include('views/comentario_calzado/form.php');
            }
          break;
          case 'get':
          default:
            $comentario_calzado->validatePrivilegio('Comentario calzado leer');
            $data = $comentario_calzado->get();
            include('views/comentario_calzado/index.php');
          break;
        }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>