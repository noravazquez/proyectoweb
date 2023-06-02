<?php 
  header('Content-Type: application/json; charset=utf-8');
  include_once(__DIR__.'/../admin/controllers/sistema.php');
  include_once(__DIR__."/../admin/controllers/rol.php");

  $action = $_SERVER['REQUEST_METHOD'];
  $idRol = isset($_GET['id']) ? $_GET['id'] : null;

  switch ($action) {
    case 'DELETE':
      $data['mensaje'] = 'No existe el rol';
      if (!is_null($idRol)) {
        $contador = $rol->delete($idRol);
        if ($contador == 1) {
          $data['mensaje']= 'Se elimino el rol';
        }
      }
    break;
    case 'POST':
      $data = array();
      $data = $_POST['data'];
      if (is_null($idRol)) {
        $cantidad = $rol->new($data);
        if ($cantidad !=0) {
          $data['mensaje']='Se inserto el rol.';
        }else{
          $data['mensaje']='Ocurrio un error';
        }
      }else {
        $cantidad = $rol->edit($idRol, $data);
        if ($cantidad !=0) {
          $data['mensaje']='Se actualizo el rol.';
          //$data[]
        }else{
          $data['mensaje']='Ocurrio un error';
        }
      }
    break;
    case 'GET':
    default:
      if (is_null($idRol)) {
        $data = $rol->get();
      } else {
        $data = $rol->get($idRol);
      }
    break;
  }

$data = json_encode($data);
echo ($data);
?>