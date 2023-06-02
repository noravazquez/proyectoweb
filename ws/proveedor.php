<?php 
  header('Content-Type: application/json; charset=utf-8');
  include_once(__DIR__.'/../admin/controllers/sistema.php');
  include_once(__DIR__."/../admin/controllers/proveedor.php");

  $action = $_SERVER['REQUEST_METHOD'];
  $idProveedor = isset($_GET['id']) ? $_GET['id'] : null;

  switch ($action) {
    case 'DELETE':
      $data['mensaje'] = 'No existe el proveedor';
      if (!is_null($idProveedor)) {
        $contador = $proveedor->delete($idProveedor);
        if ($contador == 1) {
          $data['mensaje']= 'Se elimino el proveedor';
        }
      }
    break;
    case 'POST':
      $data = array();
      $data = $_POST['data'];
      if (is_null($idProveedor)) {
        $cantidad = $proveedor->new($data);
        if ($cantidad !=0) {
          $data['mensaje']='Se inserto el proveedor.';
        }else{
          $data['mensaje']='Ocurrio un error';
        }
      }else {
        $cantidad = $proveedor->edit($idProveedor, $data);
        if ($cantidad !=0) {
          $data['mensaje']='Se actualizo el proveedor.';
          //$data[]
        }else{
          $data['mensaje']='Ocurrio un error';
        }
      }
    break;
    case 'GET':
    default:
      if (is_null($idProveedor)) {
        $data = $proveedor->get();
      } else {
        $data = $proveedor->get($idProveedor);
      }
    break;
  }

$data = json_encode($data);
echo ($data);
?>