<?php 
  header('Content-Type: application/json; charset=utf-8');
  include_once(__DIR__.'/../admin/controllers/sistema.php');
  include_once(__DIR__."/../admin/controllers/juguete.php");

  $action = $_SERVER['REQUEST_METHOD'];
  $idJuguete = isset($_GET['id']) ? $_GET['id'] : null;

  switch ($action) {
    case 'DELETE':
      $data['mensaje'] = 'No existe el juguete';
      if (!is_null($idJuguete)) {
        $contador = $juguete->delete($idJuguete);
        if ($contador == 1) {
          $data['mensaje']= 'Se elimino el juguete';
        }
      }
    break;
    case 'POST':
      $data = array();
      $data = $_POST['data'];
      if (is_null($idJuguete)) {
        $cantidad = $juguete->new($data);
        if ($cantidad !=0) {
          $data['mensaje']='Se inserto el juguete.';
        }else{
          $data['mensaje']='Ocurrio un error';
        }
      }else {
        $cantidad = $juguete->edit($idJuguete, $data);
        if ($cantidad !=0) {
          $data['mensaje']='Se actualizo el juguete.';
          //$data[]
        }else{
          $data['mensaje']='Ocurrio un error';
        }
      }
    break;
    case 'GET':
    default:
      if (is_null($idJuguete)) {
        $data = $juguete->get();
      } else {
        $data = $juguete->get($idJuguete);
      }
    break;
  }

$data = json_encode($data);
echo ($data);
?>