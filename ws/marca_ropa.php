<?php 
  header('Content-Type: application/json; charset=utf-8');
  include_once(__DIR__.'/../admin/controllers/sistema.php');
  include_once(__DIR__."/../admin/controllers/marca_ropa.php");

  $action = $_SERVER['REQUEST_METHOD'];
  $idMarcaRopa = isset($_GET['id']) ? $_GET['id'] : null;

  switch ($action) {
    case 'DELETE':
      $data['mensaje'] = 'No existe la marca del ropa';
      if (!is_null($idMarcaRopa)) {
        $contador = $marca_ropa->delete($idMarcaRopa);
        if ($contador == 1) {
          $data['mensaje']= 'Se elimino la marca del ropa';
        }
      }
    break;
    case 'POST':
      $data = array();
      $data = $_POST['data'];
      if (is_null($idMarcaRopa)) {
        $cantidad = $marca_ropa->new($data);
        if ($cantidad !=0) {
          $data['mensaje']='Se inserto la marca del ropa.';
        }else{
            $data['mensaje']='Ocurrio un error';
        }
      }else {
        $cantidad = $marca_ropa->edit($idMarcaRopa, $data);
        if ($cantidad !=0) {
          $data['mensaje']='Se actualizo la marca del ropa.';
          //$data[]
        }else{
            $data['mensaje']='Ocurrio un error';
        }
      }
    break;
    case 'GET':
    default:
      if (is_null($idMarcaRopa)) {
        $data = $marca_ropa->get();
      } else {
        $data = $marca_ropa->get($idMarcaRopa);
      }
    break;
  }

$data = json_encode($data);
echo ($data);
?>