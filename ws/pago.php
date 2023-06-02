<?php 
  header('Content-Type: application/json; charset=utf-8');
  include_once(__DIR__.'/../admin/controllers/sistema.php');
  include_once(__DIR__."/../admin/controllers/pago.php");

  $action = $_SERVER['REQUEST_METHOD'];
  $idPedido = isset($_GET['idPedido']) ? $_GET['idPedido'] : null;
  $idMetodoPago = isset($_GET['idMetodoPago']) ? $_GET['idMetodoPago'] : null;

  switch ($action) {
    case 'DELETE':
      $data['mensaje'] = 'No existe el detalle de pedido del calzado';
      if (!is_null($idPedido) and !is_null($idMetodoPago)) {
        $contador = $pago->delete($idPedido, $idMetodoPago);
        if ($contador == 1) {
          $data['mensaje']= 'Se elimino el detalle de pedido del calzado';
        }
      }
    break;
    case 'POST':
      $data = array();
      $data = $_POST['data'];
      if (is_null($idPedido) and is_null($idMetodoPago)) {
        $cantidad = $pago->new($data);
        if ($cantidad !=0) {
          $data['mensaje']='Se inserto el detalle de pedido del calzado.';
        }else{
            $data['mensaje']='Ocurrio un error';
        }
      }else {
        $cantidad = $pago->edit($idPedido, $idMetodoPago, $data);
        if ($cantidad !=0) {
          $data['mensaje']='Se actualizo el detalle de pedido del calzado.';
          //$data[]
        }else{
            $data['mensaje']='Ocurrio un error';
        }
      }
    break;
    case 'GET':
    default:
      if (is_null($idPedido) and is_null($idMetodoPago)) {
        $data = $pago->get();
      } else {
        $data = $pago->get($idPedido, $idMetodoPago);
      }
    break;
  }

$data = json_encode($data);
echo ($data);
?>