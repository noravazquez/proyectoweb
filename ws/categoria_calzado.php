<?php 
  header('Content-Type: application/json; charset=utf-8');
  include_once(__DIR__.'/../admin/controllers/sistema.php');
  include_once(__DIR__."/../admin/controllers/categoria_calzado.php");

  $action = $_SERVER['REQUEST_METHOD'];
  $idCategoriaCalzado = isset($_GET['id']) ? $_GET['id'] : null;

  switch ($action) {
    case 'DELETE':
      $data['mensaje'] = 'No existe la categoria del calzado';
      if (!is_null($idCategoriaCalzado)) {
        $contador = $categoria_calzado->delete($idCategoriaCalzado);
        if ($contador == 1) {
          $data['mensaje']= 'Se elimino la categoria del calzado';
        }
      }
    break;
    case 'POST':
      $data = array();
      $data = $_POST['data'];
      if (is_null($idCategoriaCalzado)) {
        $cantidad = $categoria_calzado->new($data);
        if ($cantidad !=0) {
          $data['mensaje']='Se inserto la categoria del calzado.';
        }else{
            $data['mensaje']='Ocurrio un error';
        }
      }else {
        $cantidad = $categoria_calzado->edit($idCategoriaCalzado, $data);
        if ($cantidad !=0) {
          $data['mensaje']='Se actualizo la categoria del calzado.';
          //$data[]
        }else{
            $data['mensaje']='Ocurrio un error';
        }
      }
    break;
    case 'GET':
    default:
      if (is_null($idCategoriaCalzado)) {
        $data = $categoria_calzado->get();
      } else {
        $data = $categoria_calzado->get($idCategoriaCalzado);
      }
    break;
  }

$data = json_encode($data);
echo ($data);
?>