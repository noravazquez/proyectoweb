<?php 
  header('Content-Type: application/json; charset=utf-8');
  include_once(__DIR__.'/../admin/controllers/sistema.php');
  include_once(__DIR__."/../admin/controllers/sucursal.php");

  $action = $_SERVER['REQUEST_METHOD'];
  $idSucursal = isset($_GET['id']) ? $_GET['id'] : null;

  switch ($action) {
    case 'DELETE':
      $data['mensaje'] = 'No existe el sucursal';
      if (!is_null($idSucursal)) {
        $contador = $sucursal->delete($idSucursal);
        if ($contador == 1) {
          $data['mensaje']= 'Se elimino el sucursal';
        }
      }
    break;
    case 'POST':
      $data = array();
      $data = $_POST['data'];
      if (is_null($idSucursal)) {
        $cantidad = $sucursal->new($data);
        if ($cantidad !=0) {
          $data['mensaje']='Se inserto el sucursal.';
        }else{
          $data['mensaje']='Ocurrio un error';
        }
      }else {
        $cantidad = $sucursal->edit($idSucursal, $data);
        if ($cantidad !=0) {
          $data['mensaje']='Se actualizo el sucursal.';
          //$data[]
        }else{
          $data['mensaje']='Ocurrio un error';
        }
      }
    break;
    case 'GET':
    default:
      if (is_null($idSucursal)) {
        $data = $sucursal->get();
      } else {
        $data = $sucursal->get($idSucursal);
      }
    break;
  }

$data = json_encode($data);
echo ($data);
?>