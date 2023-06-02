<?php 
  header('Content-Type: application/json; charset=utf-8');
  include_once(__DIR__.'/../admin/controllers/sistema.php');
  include_once(__DIR__."/../admin/controllers/respuesta_ropa.php");

  $action = $_SERVER['REQUEST_METHOD'];
  $idRespuestaRopa = isset($_GET['id']) ? $_GET['id'] : null;

  switch ($action) {
    case 'DELETE':
      $data['mensaje'] = 'No existe la respuesta del ropa';
      if (!is_null($idRespuestaRopa)) {
        $contador = $respuesta_ropa->delete($idRespuestaRopa);
        if ($contador == 1) {
          $data['mensaje']= 'Se elimino la respuesta del ropa';
        }
      }
    break;
    case 'POST':
      $data = array();
      $data = $_POST['data'];
      if (is_null($idRespuestaRopa)) {
        $cantidad = $respuesta_ropa->new($data);
        if ($cantidad !=0) {
          $data['mensaje']='Se inserto la respuesta del ropa.';
        }else{
            $data['mensaje']='Ocurrio un error';
        }
      }else {
        $cantidad = $respuesta_ropa->edit($idRespuestaRopa, $data);
        if ($cantidad !=0) {
          $data['mensaje']='Se actualizo la respuesta del ropa.';
          //$data[]
        }else{
            $data['mensaje']='Ocurrio un error';
        }
      }
    break;
    case 'GET':
    default:
      if (is_null($idRespuestaRopa)) {
        $data = $respuesta_ropa->get();
      } else {
        $data = $respuesta_ropa->get($idRespuestaRopa);
      }
    break;
  }

$data = json_encode($data);
echo ($data);
?>