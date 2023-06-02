<?php 
  header('Content-Type: application/json; charset=utf-8');
  include_once(__DIR__.'/../admin/controllers/sistema.php');
  include_once(__DIR__."/../admin/controllers/marca_calzado.php");

  $action = $_SERVER['REQUEST_METHOD'];
  $idMarcaCalzado = isset($_GET['id']) ? $_GET['id'] : null;

  switch ($action) {
    case 'DELETE':
      $data['mensaje'] = 'No existe la marca del calzado';
      if (!is_null($idMarcaCalzado)) {
        $contador = $marca_calzado->delete($idMarcaCalzado);
        if ($contador == 1) {
          $data['mensaje']= 'Se elimino la marca del calzado';
        }
      }
    break;
    case 'POST':
      $data = array();
      $data = $_POST['data'];
      if (is_null($idMarcaCalzado)) {
        $cantidad = $marca_calzado->new($data);
        if ($cantidad !=0) {
          $data['mensaje']='Se inserto la marca del calzado.';
        }else{
            $data['mensaje']='Ocurrio un error';
        }
      }else {
        $cantidad = $marca_calzado->edit($idMarcaCalzado, $data);
        if ($cantidad !=0) {
          $data['mensaje']='Se actualizo la marca del calzado.';
          //$data[]
        }else{
            $data['mensaje']='Ocurrio un error';
        }
      }
    break;
    case 'GET':
    default:
      if (is_null($idMarcaCalzado)) {
        $data = $marca_calzado->get();
      } else {
        $data = $marca_calzado->get($idMarcaCalzado);
      }
    break;
  }

$data = json_encode($data);
echo ($data);
?>