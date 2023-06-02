<?php 
  header('Content-Type: application/json; charset=utf-8');
  include_once(__DIR__.'/../admin/controllers/sistema.php');
  include_once(__DIR__."/../admin/controllers/privilegio.php");

  $action = $_SERVER['REQUEST_METHOD'];
  $idPrivilegio = isset($_GET['id']) ? $_GET['id'] : null;

  switch ($action) {
    case 'DELETE':
      $data['mensaje'] = 'No existe el privilegio';
      if (!is_null($idPrivilegio)) {
        $contador = $privilegio->delete($idPrivilegio);
        if ($contador == 1) {
          $data['mensaje']= 'Se elimino el privilegio';
        }
      }
    break;
    case 'POST':
      $data = array();
      $data = $_POST['data'];
      if (is_null($idPrivilegio)) {
        $cantidad = $privilegio->new($data);
        if ($cantidad !=0) {
          $data['mensaje']='Se inserto el privilegio.';
        }else{
          $data['mensaje']='Ocurrio un error';
        }
      }else {
        $cantidad = $privilegio->edit($idPrivilegio, $data);
        if ($cantidad !=0) {
          $data['mensaje']='Se actualizo el privilegio.';
          //$data[]
        }else{
          $data['mensaje']='Ocurrio un error';
        }
      }
    break;
    case 'GET':
    default:
      if (is_null($idPrivilegio)) {
        $data = $privilegio->get();
      } else {
        $data = $privilegio->get($idPrivilegio);
      }
    break;
  }

$data = json_encode($data);
echo ($data);
?>