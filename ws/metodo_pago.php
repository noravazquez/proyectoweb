<?php 
  header('Content-Type: application/json; charset=utf-8');
  include_once(__DIR__.'/../admin/controllers/sistema.php');
  include_once(__DIR__."/../admin/controllers/metodo_pago.php");

  $action = $_SERVER['REQUEST_METHOD'];
  $idMetodoPago = isset($_GET['id']) ? $_GET['id'] : null;

  switch ($action) {
    case 'DELETE':
      $data['mensaje'] = 'No existe el metodo pago';
      if (!is_null($idMetodoPago)) {
        $contador = $metodo_pago->delete($idMetodoPago);
        if ($contador == 1) {
          $data['mensaje']= 'Se elimino el metodo pago';
        }
      }
    break;
    case 'POST':
      $data = array();
      $data = $_POST['data'];
      if (is_null($idMetodoPago)) {
        $cantidad = $metodo_pago->new($data);
        if ($cantidad !=0) {
          $data['mensaje']='Se inserto el metodo pago.';
        }else{
          $data['mensaje']='Ocurrio un error';
        }
      }else {
        $cantidad = $metodo_pago->edit($idMetodoPago, $data);
        if ($cantidad !=0) {
          $data['mensaje']='Se actualizo el metodo pago.';
          //$data[]
        }else{
          $data['mensaje']='Ocurrio un error';
        }
      }
    break;
    case 'GET':
    default:
      if (is_null($idMetodoPago)) {
        $data = $metodo_pago->get();
      } else {
        $data = $metodo_pago->get($idMetodoPago);
      }
    break;
  }

$data = json_encode($data);
echo ($data);
?>