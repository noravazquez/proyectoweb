<?php 
  header('Content-Type: application/json; charset=utf-8');
  include_once(__DIR__.'/../admin/controllers/sistema.php');
  include_once(__DIR__."/../admin/controllers/comentario_juguete.php");

  $action = $_SERVER['REQUEST_METHOD'];
  $idComentarioJuguete = isset($_GET['id']) ? $_GET['id'] : null;

  switch ($action) {
    case 'DELETE':
      $data['mensaje'] = 'No existe el comentario del juguete';
      if (!is_null($idComentarioJuguete)) {
        $contador = $comentario_juguete->delete($idComentarioJuguete);
        if ($contador == 1) {
          $data['mensaje']= 'Se elimino el comentario del juguete';
        }
      }
    break;
    case 'POST':
      $data = array();
      $data = $_POST['data'];
      if (is_null($idComentarioJuguete)) {
        $cantidad = $comentario_juguete->new($data);
        if ($cantidad !=0) {
          $data['mensaje']='Se inserto el comentario del juguete.';
        }else{
            $data['mensaje']='Ocurrio un error';
        }
      }else {
        $cantidad = $comentario_juguete->edit($idComentarioJuguete, $data);
        if ($cantidad !=0) {
          $data['mensaje']='Se actualizo el comentario del juguete.';
          //$data[]
        }else{
            $data['mensaje']='Ocurrio un error';
        }
      }
    break;
    case 'GET':
    default:
      if (is_null($idComentarioJuguete)) {
        $data = $comentario_juguete->get();
      } else {
        $data = $comentario_juguete->get($idComentarioJuguete);
      }
    break;
  }

$data = json_encode($data);
echo ($data);
?>