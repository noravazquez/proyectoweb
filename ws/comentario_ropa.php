<?php 
  header('Content-Type: application/json; charset=utf-8');
  include_once(__DIR__.'/../admin/controllers/sistema.php');
  include_once(__DIR__."/../admin/controllers/comentario_ropa.php");

  $action = $_SERVER['REQUEST_METHOD'];
  $idComentarioRopa = isset($_GET['id']) ? $_GET['id'] : null;

  switch ($action) {
    case 'DELETE':
      $data['mensaje'] = 'No existe el comentario de la ropa';
      if (!is_null($idComentarioRopa)) {
        $contador = $comentario_ropa->delete($idComentarioRopa);
        if ($contador == 1) {
          $data['mensaje']= 'Se elimino el comentario de la ropa';
        }
      }
    break;
    case 'POST':
      $data = array();
      $data = $_POST['data'];
      if (is_null($idComentarioRopa)) {
        $cantidad = $comentario_ropa->new($data);
        if ($cantidad !=0) {
          $data['mensaje']='Se inserto el comentario de la ropa.';
        }else{
            $data['mensaje']='Ocurrio un error';
        }
      }else {
        $cantidad = $comentario_ropa->edit($idComentarioRopa, $data);
        if ($cantidad !=0) {
          $data['mensaje']='Se actualizo el comentario de la ropa.';
          //$data[]
        }else{
            $data['mensaje']='Ocurrio un error';
        }
      }
    break;
    case 'GET':
    default:
      if (is_null($idComentarioRopa)) {
        $data = $comentario_ropa->get();
      } else {
        $data = $comentario_ropa->get($idComentarioRopa);
      }
    break;
  }

$data = json_encode($data);
echo ($data);
?>