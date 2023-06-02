<?php 
  header('Content-Type: application/json; charset=utf-8');
  include_once(__DIR__.'/../admin/controllers/sistema.php');
  include_once(__DIR__."/../admin/controllers/marca_juguete.php");

  $action = $_SERVER['REQUEST_METHOD'];
  $idMarcaJuguete = isset($_GET['id']) ? $_GET['id'] : null;

  switch ($action) {
    case 'DELETE':
      $data['mensaje'] = 'No existe la marca del juguete';
      if (!is_null($idMarcaJuguete)) {
        $contador = $marca_juguete->delete($idMarcaJuguete);
        if ($contador == 1) {
          $data['mensaje']= 'Se elimino la marca del juguete';
        }
      }
    break;
    case 'POST':
      $data = array();
      $data = $_POST['data'];
      if (is_null($idMarcaJuguete)) {
        $cantidad = $marca_juguete->new($data);
        if ($cantidad !=0) {
          $data['mensaje']='Se inserto la marca del juguete.';
        }else{
            $data['mensaje']='Ocurrio un error';
        }
      }else {
        $cantidad = $marca_juguete->edit($idMarcaJuguete, $data);
        if ($cantidad !=0) {
          $data['mensaje']='Se actualizo la marca del juguete.';
          //$data[]
        }else{
            $data['mensaje']='Ocurrio un error';
        }
      }
    break;
    case 'GET':
    default:
      if (is_null($idMarcaJuguete)) {
        $data = $marca_juguete->get();
      } else {
        $data = $marca_juguete->get($idMarcaJuguete);
      }
    break;
  }

$data = json_encode($data);
echo ($data);
?>