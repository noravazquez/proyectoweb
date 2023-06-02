<?php 
  header('Content-Type: application/json; charset=utf-8');
  include_once(__DIR__.'/../admin/controllers/sistema.php');
  include_once(__DIR__."/../admin/controllers/calzado.php");

  $action = $_SERVER['REQUEST_METHOD'];
  $idCalzado = isset($_GET['id']) ? $_GET['id'] : null;

  switch ($action) {
    case 'DELETE':
      $data['mensaje'] = 'No existe el calzado';
      if (!is_null($idCalzado)) {
        $contador = $calzado->delete($idCalzado);
        if ($contador == 1) {
          $data['mensaje']= 'Se elimino el calzado';
        }
      }
    break;
    case 'POST':
      $data = array();
      $data = $_POST['data'];
      if (is_null($idCalzado)) {
        $cantidad = $calzado->new($data);
        if ($cantidad !=0) {
          $data['mensaje']='Se inserto el calzado.';
        }else{
          $data['mensaje']='Ocurrio un error';
        }
      }else {
        $cantidad = $calzado->edit($idCalzado, $data);
        if ($cantidad !=0) {
          $data['mensaje']='Se actualizo el calzado.';
          //$data[]
        }else{
          $data['mensaje']='Ocurrio un error';
        }
      }
    break;
    case 'GET':
    default:
      if (is_null($idCalzado)) {
        $data = $calzado->get();
      } else {
        $data = $calzado->get($idCalzado);
      }
    break;
  }

$data = json_encode($data);
echo ($data);
?>