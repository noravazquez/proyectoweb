<?php 
  header('Content-Type: application/json; charset=utf-8');
  include_once(__DIR__.'/../admin/controllers/sistema.php');
  include_once(__DIR__."/../admin/controllers/respuesta_juguete.php");

  $action = $_SERVER['REQUEST_METHOD'];
  $idRespuestaJuguete = isset($_GET['id']) ? $_GET['id'] : null;

  switch ($action) {
    case 'DELETE':
      $data['mensaje'] = 'No existe la respuesta del juguete';
      if (!is_null($idRespuestaJuguete)) {
        $contador = $respuesta_juguete->delete($idRespuestaJuguete);
        if ($contador == 1) {
          $data['mensaje']= 'Se elimino la respuesta del juguete';
        }
      }
    break;
    case 'POST':
      $data = array();
      $data = $_POST['data'];
      if (is_null($idRespuestaJuguete)) {
        $cantidad = $respuesta_juguete->new($data);
        if ($cantidad !=0) {
          $data['mensaje']='Se inserto la respuesta del juguete.';
        }else{
            $data['mensaje']='Ocurrio un error';
        }
      }else {
        $cantidad = $respuesta_juguete->edit($idRespuestaJuguete, $data);
        if ($cantidad !=0) {
          $data['mensaje']='Se actualizo la respuesta del juguete.';
          //$data[]
        }else{
            $data['mensaje']='Ocurrio un error';
        }
      }
    break;
    case 'GET':
    default:
      if (is_null($idRespuestaJuguete)) {
        $data = $respuesta_juguete->get();
      } else {
        $data = $respuesta_juguete->get($idRespuestaJuguete);
      }
    break;
  }

$data = json_encode($data);
echo ($data);
?>