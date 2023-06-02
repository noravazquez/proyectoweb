<?php 
  header('Content-Type: application/json; charset=utf-8');
  include_once(__DIR__.'/../admin/controllers/sistema.php');
  include_once(__DIR__."/../admin/controllers/ropa.php");

  $action = $_SERVER['REQUEST_METHOD'];
  $idRopa = isset($_GET['id']) ? $_GET['id'] : null;

  switch ($action) {
    case 'DELETE':
      $data['mensaje'] = 'No existe el ropa';
      if (!is_null($idRopa)) {
        $contador = $ropa->delete($idRopa);
        if ($contador == 1) {
          $data['mensaje']= 'Se elimino el ropa';
        }
      }
    break;
    case 'POST':
      $data = array();
      $data = $_POST['data'];
      if (is_null($idRopa)) {
        $cantidad = $ropa->new($data);
        if ($cantidad !=0) {
          $data['mensaje']='Se inserto el ropa.';
        }else{
          $data['mensaje']='Ocurrio un error';
        }
      }else {
        $cantidad = $ropa->edit($idRopa, $data);
        if ($cantidad !=0) {
          $data['mensaje']='Se actualizo el ropa.';
          //$data[]
        }else{
          $data['mensaje']='Ocurrio un error';
        }
      }
    break;
    case 'GET':
    default:
      if (is_null($idRopa)) {
        $data = $ropa->get();
      } else {
        $data = $ropa->get($idRopa);
      }
    break;
  }

$data = json_encode($data);
echo ($data);
?>