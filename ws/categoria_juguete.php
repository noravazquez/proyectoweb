<?php 
  header('Content-Type: application/json; charset=utf-8');
  include_once(__DIR__.'/../admin/controllers/sistema.php');
  include_once(__DIR__."/../admin/controllers/categoria_juguete.php");

  $action = $_SERVER['REQUEST_METHOD'];
  $idCategoriaJuguete = isset($_GET['id']) ? $_GET['id'] : null;

  switch ($action) {
    case 'DELETE':
      $data['mensaje'] = 'No existe la categoria juguete';
      if (!is_null($idCategoriaJuguete)) {
        $contador = $categoria_juguete->delete($idCategoriaJuguete);
        if ($contador == 1) {
          $data['mensaje']= 'Se elimino la categoria juguete';
        }
      }
    break;
    case 'POST':
      $data = array();
      $data = $_POST['data'];
      if (is_null($idCategoriaJuguete)) {
        $cantidad = $categoria_juguete->new($data);
        if ($cantidad !=0) {
          $data['mensaje']='Se inserto la categoria juguete.';
        }else{
          $data['mensaje']='Ocurrio un error';
        }
      }else {
        $cantidad = $categoria_juguete->edit($idCategoriaJuguete, $data);
        if ($cantidad !=0) {
          $data['mensaje']='Se actualizo la categoria juguete.';
          //$data[]
        }else{
          $data['mensaje']='Ocurrio un error';
        }
      }
    break;
    case 'GET':
    default:
      if (is_null($idCategoriaJuguete)) {
        $data = $categoria_juguete->get();
      } else {
        $data = $categoria_juguete->get($idCategoriaJuguete);
      }
    break;
  }

$data = json_encode($data);
echo ($data);
?>