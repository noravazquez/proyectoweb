<?php require_once (__DIR__."/controllers/empleado.php"); 
      require_once (__DIR__."/controllers/usuario.php");
      include_once(__DIR__."/controllers/sistema.php"); 
      $sistema->validateRol('Administrador');
      $sistema->validateRol('Gerente');
      $sistema->validateRol('Dependiente');?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD EMPLEADO</title>
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
        $idEmpleado = (isset($_GET['id'])) ? $_GET['id'] : null;
        $idUsuario = (isset($_GET['id_usuario'])) ? $_GET['id_usuario'] : null;

        switch ($action) {
          case 'new':
            $empleado->validatePrivilegio('Empleado crear');
            $data_usuario = $usuario->get();
            if (isset($_POST['enviar'])) {
                $data = $_POST['data'];
                $cantidad = $empleado->new($data);
                if ($cantidad) {
                    $empleado->alert('success', 'bi bi-check-circle-fill', 'NUEVO EMPLEADO', 'El empleado fue agregado correctamente.');
                    $data = $empleado->get();
                    include('views/empleado/index.php');
                } else {
                    $empleado->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
                    $data = $empleado->get();
                    include('views/empleado/index.php');
                }
            }else {
              include('views/empleado/form.php');
            } 
          break;
          case 'delete':
            $empleado->validatePrivilegio('Empleado eliminar');
            $cantidad = $empleado->delete($idEmpleado);
            if ($cantidad) {
              $empleado->alert('success', 'bi bi-check-circle-fill', 'EMPLEADO ELIMINADO', 'El empleado fue eliminado correctamente.');
              $data = $empleado->get();
              include('views/empleado/index.php');
            } else {
              $empleado->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
              $data = $empleado->get();
              include('views/empleado/index.php');
            }
          break;
          case 'edit':
            $empleado->validatePrivilegio('Empleado editar');
            $data_usuario = $usuario->get();
            if (isset($_POST['enviar'])) {
              $data = $_POST['data'];
              $idEmpleado = $_POST['data']['id_empleado'];
              $cantidad = $empleado->edit($idEmpleado, $data);
              if ($cantidad) {
                $empleado->alert('success', 'bi bi-check-circle-fill', 'EMPLEADO ACTUALIZADO', 'El empleado fue actualizado correctamente.');
                $data = $empleado->get();
                include('views/empleado/index.php');
              } else {
                $empleado->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
                $data = $empleado->get();
                include('views/empleado/index.php');
              }
            }else {
              $data = $empleado->get($idEmpleado);
              include('views/empleado/form.php');
            }
          break;
          case 'get':
          default:
            $empleado->validatePrivilegio('Empleado leer');
            $data = $empleado->get();
            include('views/empleado/index.php');
          break;
        }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>