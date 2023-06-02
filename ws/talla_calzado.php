<?php 
  header('Content-Type: application/json; charset=utf-8');
  include_once(__DIR__.'/../admin/controllers/sistema.php');
  include_once(__DIR__."/../admin/controllers/talla_calzado.php");

  $action = $_SERVER['REQUEST_METHOD'];
  $idTallaCalzado = isset($_GET['id']) ? $_GET['id'] : null;

  switch ($action) {
    case 'DELETE':
      $data['mensaje'] = 'No existe la talla del calzado';
      if (!is_null($idTallaCalzado)) {
        $contador = $talla_calzado->delete($idTallaCalzado);
        if ($contador == 1) {
          $data['mensaje']= 'Se elimino la talla del calzado';
        }
      }
    break;
    case 'POST':
      $data = array();
      $data = $_POST['data'];
      if (is_null($idTallaCalzado)) {
        $cantidad = $talla_calzado->new($data);
        if ($cantidad !=0) {
          $data['mensaje']='Se inserto la talla del calzado.';
        }else{
            $data['mensaje']='Ocurrio un error';
        }
      }else {
        $cantidad = $talla_calzado->edit($idTallaCalzado, $data);
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
      if (is_null($idTallaCalzado)) {
        $data = $talla_calzado->get();
      } else {
        $data = $talla_calzado->get($idTallaCalzado);
      }
    break;
  }

$data = json_encode($data);
echo ($data);
?>