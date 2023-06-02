<?php 
  header('Content-Type: application/json; charset=utf-8');
  include_once(__DIR__.'/../admin/controllers/sistema.php');
  include_once(__DIR__."/../admin/controllers/detalle_pedido_juguete.php");

  $action = $_SERVER['REQUEST_METHOD'];
  $idPedido = isset($_GET['idPedido']) ? $_GET['idPedido'] : null;
  $idJuguete = isset($_GET['idJuguete']) ? $_GET['idJuguete'] : null;

  switch ($action) {
    case 'DELETE':
      $data['mensaje'] = 'No existe el detalle de pedido del juguete';
      if (!is_null($idPedido) and !is_null($idJuguete)) {
        $contador = $detalle_pedido_juguete->delete($idPedido, $idJuguete);
        if ($contador == 1) {
          $data['mensaje']= 'Se elimino el detalle de pedido del juguete';
        }
      }
    break;
    case 'POST':
      $data = array();
      $data = $_POST['data'];
      if (is_null($idPedido) and is_null($idJuguete)) {
        $cantidad = $detalle_pedido_juguete->new($data);
        if ($cantidad !=0) {
          $data['mensaje']='Se inserto el detalle de pedido del juguete.';
        }else{
            $data['mensaje']='Ocurrio un error';
        }
      }else {
        $cantidad = $detalle_pedido_juguete->edit($idPedido, $idJuguete, $data);
        if ($cantidad !=0) {
          $data['mensaje']='Se actualizo el detalle de pedido del juguete.';
          //$data[]
        }else{
            $data['mensaje']='Ocurrio un error';
        }
      }
    break;
    case 'GET':
    default:
      if (is_null($idPedido) and is_null($idJuguete)) {
        $data = $detalle_pedido_juguete->get();
      } else {
        $data = $detalle_pedido_juguete->get($idPedido, $idJuguete);
      }
    break;
  }

$data = json_encode($data);
echo ($data);
?>