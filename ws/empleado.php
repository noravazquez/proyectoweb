<?php 
  header('Content-Type: application/json; charset=utf-8');
  include_once(__DIR__.'/../admin/controllers/sistema.php');
  include_once(__DIR__."/../admin/controllers/empleado.php");

  $action = $_SERVER['REQUEST_METHOD'];
  $idEmpleado = isset($_GET['id']) ? $_GET['id'] : null;

  switch ($action) {
    case 'DELETE':
      $data['mensaje'] = 'No existe el empleado';
      if (!is_null($idEmpleado)) {
        $contador = $empleado->delete($idEmpleado);
        if ($contador == 1) {
          $data['mensaje']= 'Se elimino el empleado';
        }
      }
    break;
    case 'POST':
      $data = array();
      $data = $_POST['data'];
      if (is_null($idEmpleado)) {
        $cantidad = $empleado->new($data);
        if ($cantidad !=0) {
          $data['mensaje']='Se inserto el empleado.';
        }else{
          $data['mensaje']='Ocurrio un error';
        }
      }else {
        $cantidad = $empleado->edit($idEmpleado, $data);
        if ($cantidad !=0) {
          $data['mensaje']='Se actualizo el empleado.';
          //$data[]
        }else{
          $data['mensaje']='Ocurrio un error';
        }
      }
    break;
    case 'GET':
    default:
      if (is_null($idEmpleado)) {
        $data = $empleado->get();
      } else {
        $data = $empleado->get($idEmpleado);
      }
    break;
  }

$data = json_encode($data);
echo ($data);
?>