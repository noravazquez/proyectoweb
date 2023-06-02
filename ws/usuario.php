<?php 
  header('Content-Type: application/json; charset=utf-8');
  include_once(__DIR__.'/../admin/controllers/sistema.php');
  include_once(__DIR__."/../admin/controllers/usuario.php");

  $action = $_SERVER['REQUEST_METHOD'];
  $idUsuario = isset($_GET['id']) ? $_GET['id'] : null;

  switch ($action) {
    case 'DELETE':
      $data['mensaje'] = 'No existe la talla del calzado';
      if (!is_null($idUsuario)) {
        $contador = $usuario->delete($idUsuario);
        if ($contador == 1) {
          $data['mensaje']= 'Se elimino la talla del calzado';
        }
      }
    break;
    case 'POST':
      $data = array();
      $data = $_POST['data'];
      if (is_null($idUsuario)) {
        $cantidad = $usuario->new($data);
        if ($cantidad !=0) {
          $data['mensaje']='Se inserto la talla del calzado.';
        }else{
            $data['mensaje']='Ocurrio un error';
        }
      }else {
        $cantidad = $usuario->edit($idUsuario, $data);
        if ($cantidad !=0) {
          $data['mensaje']='Se actualizo la talla del calzado.';
          //$data[]
        }else{
            $data['mensaje']='Ocurrio un error';
        }
      }
    break;
    case 'GET':
    default:
      if (is_null($idUsuario)) {
        $data = $usuario->get();
      } else {
        $data = $usuario->get($idUsuario);
      }
    break;
  }

$data = json_encode($data);
echo ($data);
?>