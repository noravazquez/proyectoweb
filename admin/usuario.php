<?php require_once (__DIR__."/controllers/usuario.php"); 
      require_once (__DIR__."/controllers/rol.php");?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD USUARIO</title>
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
        $idUsuario = (isset($_GET['id'])) ? $_GET['id'] : null;
        $idRol = (isset($_GET['id_rol'])) ? $_GET['id_rol'] : null;

        switch ($action) {
            case 'new':
                $usuario->validatePrivilegio('Usuario crear');
                if (isset($_POST['enviar'])) {
                    $data = $_POST['data'];
                    $cantidad = $usuario->new($data);
                    if ($cantidad) {
                        $usuario->alert('success', 'bi bi-check-circle-fill', 'NUEVO USUARIO', 'El usuario fue agregado correctamente.');
                        $data = $usuario->get();
                        include('views/usuario/index.php');
                    }else{
                        $usuario->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo, probablemente el correo ya este registrado, intente con otro correo.');
                        $data = $usuario->get();
                        include('views/usuario/index.php');
                    }
                }else {
                    include('views/usuario/form.php');
                } 
            break;
            case 'delete':
                $usuario->validatePrivilegio('Usuario eliminar');
                $cantidad = $usuario->delete($idUsuario);
                if ($cantidad) {
                $usuario->alert('success', 'bi bi-check-circle-fill', 'USUARIO ELIMINADO', 'El usuario fue eliminado correctamente.');
                $data = $usuario->get();
                include('views/usuario/index.php');
                } else {
                $usuario->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
                $data = $usuario->get();
                include('views/usuario/index.php');
                }
            break;
            case 'edit':
                $usuario->validatePrivilegio('Usuario editar');
                if (isset($_POST['enviar'])) {
                $data = $_POST['data'];
                $idUsuario = $_POST['data']['id_usuario'];
                $cantidad = $usuario->edit($idUsuario, $data);
                if ($cantidad) {
                    $usuario->alert('success', 'bi bi-check-circle-fill', 'USUARIO ACTUALIZADO', 'El usuario fue actualizado correctamente.');
                    $data = $usuario->get();
                    include('views/usuario/index.php');
                } else {
                    $usuario->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
                    $data = $usuario->get();
                    include('views/usuario/index.php');
                }
                }else {
                $data = $usuario->get($idUsuario);
                include('views/usuario/form.php');
                }
            break;
            case 'rol':
                $usuario->validatePrivilegio('Usuario leer');
                $data = $usuario->get($idUsuario);
                $data_rol = $usuario->getRol($idUsuario);
                include('views/usuario/rol.php');
            break;
            case 'deleterol':
                $usuario->validatePrivilegio('Usuario eliminar');
                $cantidad = $usuario->deleteRol($idUsuario, $idRol);
                if ($cantidad) {
                    $usuario->alert('success', 'bi bi-check-circle-fill', 'ROL ELIMINADO', 'El rol fue eliminado correctamente.');
                    $data = $usuario->get($idUsuario);
                    $data_rol = $usuario->getRol($idUsuario);
                    include('views/usuario/rol.php');
                }else {
                    $usuario->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
                    $data = $usuario->get($idUsuario);
                    $data_rol = $usuario->getRol($idUsuario);
                    include('views/usuario/rol.php');
                }
            break;
            case 'newrol':
                $usuario->validatePrivilegio('Usuario crear');
                $data = $usuario->get($idUsuario);
                $roles_asignados = $usuario->getRol($idUsuario);
                $todos_los_roles = $rol->get();

                $roles_disponibles = array_filter($todos_los_roles, function($rol) use ($roles_asignados) {
                    foreach ($roles_asignados as $asignado) {
                        if ($rol['id_rol'] == $asignado['id_rol']) {
                            return false;
                        }
                    }
                    return true;
                });
                if (isset($_POST['enviar'])) {
                    $data2 = $_POST['data'];
                    $cantidad = $usuario->newRol($idUsuario, $data2);
                    if ($cantidad) {
                        $usuario->alert('success', 'bi bi-check-circle-fill', 'USUARIO ASIGNADO', 'El usuario fue asignado correctamente.');
                    } else {
                        $usuario->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
                    }
                    $data_rol = $usuario->getRol($idUsuario);
                    include('views/usuario/rol.php');
                } else {
                    include('views/usuario/rol_form.php');
                }
            break;
            case 'get':
            default:
                $usuario->validatePrivilegio('Usuario leer');
                $data = $usuario->get();
                include('views/usuario/index.php');
            break;
        }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>