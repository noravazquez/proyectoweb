<?php 
  header('Content-Type: application/json; charset=utf-8');
  include_once(__DIR__.'/../admin/controllers/sistema.php');
  include_once(__DIR__."/../admin/controllers/cliente.php");

  $action = $_SERVER['REQUEST_METHOD'];
  $idCliente = isset($_GET['id']) ? $_GET['id'] : null;

  switch ($action) {
    case 'DELETE':
      $data['mensaje'] = 'No existe el cliente';
      if (!is_null($idCliente)) {
        $contador = $cliente->delete($idCliente);
        if ($contador == 1) {
          $data['mensaje']= 'Se elimino el cliente';
        }
      }
    break;
    case 'POST':
      $data = array();
      $data = $_POST['data'];
      if (is_null($idCliente)) {
        $cantidad = $cliente->new($data);
        if ($cantidad !=0) {
          $data['mensaje']='Se inserto el cliente.';
        }else{
          $data['mensaje']='Ocurrio un error';
        }
      }else {
        $cantidad = $cliente->edit($idCliente, $data);
        if ($cantidad !=0) {
          $data['mensaje']='Se actualizo el cliente.';
          //$data[]
        }else{
          $data['mensaje']='Ocurrio un error';
        }
      }
    break;
    case 'GET':
    default:
      if (is_null($idCliente)) {
        $data = $cliente->get();
      } else {
        $data = $cliente->get($idCliente);
      }
    break;
  }

$data = json_encode($data);
echo ($data);
?>