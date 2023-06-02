<?php 
  header('Content-Type: application/json; charset=utf-8');
  include_once(__DIR__.'/../admin/controllers/sistema.php');
  include_once(__DIR__."/../admin/controllers/detalle_pedido_ropa.php");

  $action = $_SERVER['REQUEST_METHOD'];
  $idPedido = isset($_GET['idPedido']) ? $_GET['idPedido'] : null;
  $idRopa = isset($_GET['idRopa']) ? $_GET['idRopa'] : null;

  switch ($action) {
    case 'DELETE':
      $data['mensaje'] = 'No existe el detalle de pedido del ropa';
      if (!is_null($idPedido) and !is_null($idRopa)) {
        $contador = $detalle_pedido_ropa->delete($idPedido, $idRopa);
        if ($contador == 1) {
          $data['mensaje']= 'Se elimino el detalle de pedido del ropa';
        }
      }
    break;
    case 'POST':
      $data = array();
      $data = $_POST['data'];
      if (is_null($idPedido) and is_null($idRopa)) {
        $cantidad = $detalle_pedido_ropa->new($data);
        if ($cantidad !=0) {
          $data['mensaje']='Se inserto el detalle de pedido del ropa.';
        }else{
            $data['mensaje']='Ocurrio un error';
        }
      }else {
        $cantidad = $detalle_pedido_ropa->edit($idPedido, $idRopa, $data);
        if ($cantidad !=0) {
          $data['mensaje']='Se actualizo el detalle de pedido del ropa.';
          //$data[]
        }else{
            $data['mensaje']='Ocurrio un error';
        }
      }
    break;
    case 'GET':
    default:
      if (is_null($idPedido) and is_null($idRopa)) {
        $data = $detalle_pedido_ropa->get();
      } else {
        $data = $detalle_pedido_ropa->get($idPedido, $idRopa);
      }
    break;
  }

$data = json_encode($data);
echo ($data);
?>