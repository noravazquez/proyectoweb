<?php 
  header('Content-Type: application/json; charset=utf-8');
  include_once(__DIR__.'/../admin/controllers/sistema.php');
  include_once(__DIR__."/../admin/controllers/categoria_ropa.php");

  $action = $_SERVER['REQUEST_METHOD'];
  $idCategoriaRopa = isset($_GET['id']) ? $_GET['id'] : null;

  switch ($action) {
    case 'DELETE':
      $data['mensaje'] = 'No existe la categoria ropa';
      if (!is_null($idCategoriaRopa)) {
        $contador = $categoria_ropa->delete($idCategoriaRopa);
        if ($contador == 1) {
          $data['mensaje']= 'Se elimino la categoria ropa';
        }
      }
    break;
    case 'POST':
      $data = array();
      $data = $_POST['data'];
      if (is_null($idCategoriaRopa)) {
        $cantidad = $categoria_ropa->new($data);
        if ($cantidad !=0) {
          $data['mensaje']='Se inserto la categoria ropa.';
        }else{
          $data['mensaje']='Ocurrio un error';
        }
      }else {
        $cantidad = $categoria_ropa->edit($idCategoriaRopa, $data);
        if ($cantidad !=0) {
          $data['mensaje']='Se actualizo la categoria ropa.';
          //$data[]
        }else{
          $data['mensaje']='Ocurrio un error';
        }
      }
    break;
    case 'GET':
    default:
      if (is_null($idCategoriaRopa)) {
        $data = $categoria_ropa->get();
      } else {
        $data = $categoria_ropa->get($idCategoriaRopa);
      }
    break;
  }

$data = json_encode($data);
echo ($data);
?>