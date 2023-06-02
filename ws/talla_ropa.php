<?php 
  header('Content-Type: application/json; charset=utf-8');
  include_once(__DIR__.'/../admin/controllers/sistema.php');
  include_once(__DIR__."/../admin/controllers/talla_ropa.php");

  $action = $_SERVER['REQUEST_METHOD'];
  $idTallaRopa = isset($_GET['id']) ? $_GET['id'] : null;

  switch ($action) {
    case 'DELETE':
      $data['mensaje'] = 'No existe la talla del ropa';
      if (!is_null($idTallaRopa)) {
        $contador = $talla_ropa->delete($idTallaRopa);
        if ($contador == 1) {
          $data['mensaje']= 'Se elimino la talla del ropa';
        }
      }
    break;
    case 'POST':
      $data = array();
      $data = $_POST['data'];
      if (is_null($idTallaRopa)) {
        $cantidad = $talla_ropa->new($data);
        if ($cantidad !=0) {
          $data['mensaje']='Se inserto la talla del ropa.';
        }else{
            $data['mensaje']='Ocurrio un error';
        }
      }else {
        $cantidad = $talla_ropa->edit($idTallaRopa, $data);
        if ($cantidad !=0) {
          $data['mensaje']='Se actualizo la talla del ropa.';
          //$data[]
        }else{
            $data['mensaje']='Ocurrio un error';
        }
      }
    break;
    case 'GET':
    default:
      if (is_null($idTallaRopa)) {
        $data = $talla_ropa->get();
      } else {
        $data = $talla_ropa->get($idTallaRopa);
      }
    break;
  }

$data = json_encode($data);
echo ($data);
?>