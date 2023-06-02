<?php require_once (__DIR__."/controllers/privilegio.php");
      require_once (__DIR__."/controllers/rol.php");
      include_once(__DIR__."/controllers/sistema.php"); 
      $sistema->validateRol('Administrador');?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>CRUD ROL</title>
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
        $idRol = (isset($_GET['id'])) ? $_GET['id'] : null;
        $idPrivilegio = (isset($_GET['id_privilegio'])) ? $_GET['id_privilegio'] : null;

        switch ($action) {
            case 'new':
                $rol->validatePrivilegio('Rol crear');
                if (isset($_POST['enviar'])) {
                $data = $_POST['data'];
                $cantidad = $rol->new($data);
                if ($cantidad) {
                    $rol->alert('success', 'bi bi-check-circle-fill', 'NUEVO ROL', 'El rol fue agregado correctamente.');
                    $data = $rol->get();
                    include('views/rol/index.php');
                } else {
                    $rol->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
                    $data = $rol->get();
                    include('views/rol/index.php');
                }
                }else {
                include('views/rol/form.php');
                } 
            break;
            case 'delete':
                $rol->validatePrivilegio('Rol eliminar');
                $cantidad = $rol->delete($idRol);
                if ($cantidad) {
                $rol->alert('success', 'bi bi-check-circle-fill', 'ROL ELIMINADO', 'El rol fue eliminado correctamente.');
                $data = $rol->get();
                include('views/rol/index.php');
                } else {
                $rol->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
                $data = $rol->get();
                include('views/rol/index.php');
                }
            break;
            case 'edit':
                $rol->validatePrivilegio('Rol editar');
                if (isset($_POST['enviar'])) {
                $data = $_POST['data'];
                $idRol = $_POST['data']['id_rol'];
                $cantidad = $rol->edit($idRol, $data);
                if ($cantidad) {
                    $rol->alert('success', 'bi bi-check-circle-fill', 'ROL ACTUALIZADO', 'El rol fue actualizado correctamente.');
                    $data = $rol->get();
                    include('views/rol/index.php');
                } else {
                    $rol->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
                    $data = $rol->get();
                    include('views/rol/index.php');
                }
                }else {
                $data = $rol->get($idRol);
                include('views/rol/form.php');
                }
            break;
            case 'privilegio':
                $rol->validatePrivilegio('Rol leer');
                $data = $rol->get($idRol);
                $data_privilegio = $rol->getPrivilegio($idRol);
                include('views/rol/privilegio.php');
                break;
            case 'deleteprivilegio':
                $rol->validatePrivilegio('Rol eliminar');
                $cantidad = $rol->deletePrivilegio($idRol, $idPrivilegio);
                if ($cantidad) {
                    $rol->alert('success', 'bi bi-check-circle-fill', 'PRIVILEGIO ELIMINADO', 'El privilegio fue eliminado correctamente.');
                    $data = $rol->get($idRol);
                    $data_privilegio = $rol->getPrivilegio($idRol);
                    include('views/rol/privilegio.php');
                } else {
                    $rol->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
                    $data = $rol->get($idRol);
                    $data_privilegio = $rol->getPrivilegio($idRol);
                    include('views/rol/privilegio.php');
                }
                break;
            case 'newprivilegio':
                $rol->validatePrivilegio('Rol crear');
                $data = $rol->get($idRol);
                $privilegios_asignados = $rol->getPrivilegio($idRol);
                $todos_los_privilegios = $privilegio->get();
        
                $privilegios_disponibles = array_filter($todos_los_privilegios, function($privilegio) use ($privilegios_asignados) {
                    foreach ($privilegios_asignados as $asignado ) {
                        if ($privilegio['id_privilegio'] == $asignado['id_privilegio']) {
                            return false;
                        }
                    }
                    return true;
                });
        
                if (isset($_POST['enviar'])) {
                    $data2 = $_POST['data'];
                    $cantidad = $rol->newPrivilegio($idRol, $data2);
                    if ($cantidad) {
                        $rol->alert('success', 'bi bi-check-circle-fill', 'PRIVILEGIO ASIGNADO', 'El privilegio fue asignado correctamente.');
                    } else {
                        $rol->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
                    }
                    $data_privilegio = $rol->getPrivilegio($idRol);
                    include('views/rol/privilegio.php');
                } else {
                    include('views/rol/privilegio_form.php');
                }
                
                break;
            case 'get':
            default:
                $rol->validatePrivilegio('Rol leer');
                $data = $rol->get();
                include('views/rol/index.php');
            break;
        }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>