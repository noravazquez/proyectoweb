<?php 
  header('Content-Type: application/json; charset=utf-8');
  include_once(__DIR__.'/../admin/controllers/sistema.php');
  include_once(__DIR__."/../admin/controllers/comentario_calzado.php");

  $action = $_SERVER['REQUEST_METHOD'];
  $idComentarioCalzado = isset($_GET['id']) ? $_GET['id'] : null;

  switch ($action) {
    case 'DELETE':
      $data['mensaje'] = 'No existe el comentario del calzado';
      if (!is_null($idComentarioCalzado)) {
        $contador = $comentario_calzado->delete($idComentarioCalzado);
        if ($contador == 1) {
          $data['mensaje']= 'Se elimino el comentario del calzado';
        }
      }
    break;
    case 'POST':
      $data = array();
      $data = $_POST['data'];
      if (is_null($idComentarioCalzado)) {
        $cantidad = $comentario_calzado->new($data);
        if ($cantidad !=0) {
          $data['mensaje']='Se inserto el comentario del calzado.';
        }else{
            $data['mensaje']='Ocurrio un error';
        }
      }else {
        $cantidad = $comentario_calzado->edit($idComentarioCalzado, $data);
        if ($cantidad !=0) {
          $data['mensaje']='Se actualizo el comentario del calzado.';
          //$data[]
        }else{
            $data['mensaje']='Ocurrio un error';
        }
      }
    break;
    case 'GET':
    default:
      if (is_null($idComentarioCalzado)) {
        $data = $comentario_calzado->get();
      } else {
        $data = $comentario_calzado->get($idComentarioCalzado);
      }
    break;
  }

$data = json_encode($data);
echo ($data);
?>