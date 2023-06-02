<?php 
  header('Content-Type: application/json; charset=utf-8');
  include_once(__DIR__.'/../admin/controllers/sistema.php');
  include_once(__DIR__."/../admin/controllers/detalle_pedido_calzado.php");

  $action = $_SERVER['REQUEST_METHOD'];
  $idPedido = isset($_GET['idPedido']) ? $_GET['idPedido'] : null;
  $idCalzado = isset($_GET['idCalzado']) ? $_GET['idCalzado'] : null;

  switch ($action) {
    case 'DELETE':
      $data['mensaje'] = 'No existe el detalle de pedido del calzado';
      if (!is_null($idPedido) and !is_null($idCalzado)) {
        $contador = $detalle_pedido_calzado->delete($idPedido, $idCalzado);
        if ($contador == 1) {
          $data['mensaje']= 'Se elimino el detalle de pedido del calzado';
        }
      }
    break;
    case 'POST':
      $data = array();
      $data = $_POST['data'];
      if (is_null($idPedido) and is_null($idCalzado)) {
        $cantidad = $detalle_pedido_calzado->new($data);
        if ($cantidad !=0) {
          $data['mensaje']='Se inserto el detalle de pedido del calzado.';
        }else{
            $data['mensaje']='Ocurrio un error';
        }
      }else {
        $cantidad = $detalle_pedido_calzado->edit($idPedido, $idCalzado, $data);
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
      if (is_null($idPedido) and is_null($idCalzado)) {
        $data = $detalle_pedido_calzado->get();
      } else {
        $data = $detalle_pedido_calzado->get($idPedido, $idCalzado);
      }
    break;
  }

$data = json_encode($data);
echo ($data);
?>