<?php 
  header('Content-Type: application/json; charset=utf-8');
  include_once(__DIR__.'/../admin/controllers/sistema.php');
  include_once(__DIR__."/../admin/controllers/pedido.php");

  $action = $_SERVER['REQUEST_METHOD'];
  $idPedido = isset($_GET['idPedido']) ? $_GET['idPedido'] : null;

  switch ($action) {
    case 'DELETE':
      $data['mensaje'] = 'No existe el detalle de pedido del calzado';
      if (!is_null($idPedido)) {
        $contador = $pedido->delete($idPedido);
        if ($contador == 1) {
          $data['mensaje']= 'Se elimino el detalle de pedido del calzado';
        }
      }
    break;
    case 'POST':
      $data = array();
      $data = $_POST['data'];
      if (is_null($idPedido)) {
        $cantidad = $pedido->new($data);
        if ($cantidad !=0) {
          $data['mensaje']='Se inserto el detalle de pedido del calzado.';
        }else{
            $data['mensaje']='Ocurrio un error';
        }
      }else {
        $cantidad = $pedido->edit($idPedido, $data);
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
      if (is_null($idPedido)) {
        $data = $pedido->get();
      } else {
        $data = $pedido->get($idPedido);
      }
    break;
  }

$data = json_encode($data);
echo ($data);
?>