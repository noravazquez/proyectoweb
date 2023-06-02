<?php include(__DIR__.'/controllers/sistema.php');
      require_once (__DIR__."/controllers/cliente.php");
      require_once (__DIR__."/controllers/usuario.php");?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>LOGIN</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css"> 
  </head>
  <body>
    <?php
        $action = (isset($_GET['action'])) ? $_GET['action'] : 'login';

        switch($action){
            case 'forgot':
                include('views/login/forgot.php');
            break;
            case 'recovery':
                $data=$_GET;
                if (isset($data['correo']) and isset($data['token'])) {
                    if ($sistema->validateToken($data['correo'], $data['token'])) {
                        include_once('views/login/recovery.php');
                    }else {
                        $sistema->alert('danger', 'bi bi-exclamation-circle-fill', 'TOKEN EXPIRADO', 'El token ha expirado, intentelo de nuevo.');
                        include_once('views/login/index.php');
                    }
                }else {
                    $sistema->alert('danger', 'bi bi-exclamation-circle-fill', 'URL INCORRECTA', 'URL no puede ser completada como la requirio.');
                    include('views/login/index.php');
                }
            break;
            case 'send':
                if (isset($_POST['enviar'])) {
                    $correo = $_POST['correo'];
                    $cantidad = $sistema->loginSend($correo);
                    if ($cantidad) {
                        $sistema->alert('success', 'bi bi-check-circle-fill', 'CORREO ENVIADO', 'Verifique su bandeja de entrada.');
                    }else{
                        $sistema->alert('danger', 'bi bi-exclamation-circle-fill', 'ERROR', 'Ocurrio un error, verifique su correo electronico.');
                    }
                    include('views/login/index.php');
                }
            break;
            case 'reset':
                $data=$_POST;
                if (isset($data['correo']) and isset($data['token']) and isset($data['contrasena'])) {
                    if ($sistema->validateToken($data['correo'], $data['token'])) {
                        if ($sistema->resetPassword($data['correo'], $data['token'], $data['contrasena'])) {
                            $sistema->alert('success', 'bi bi-check-circle-fill', 'CONTRASEÑA RESTABLECIDA', 'La contraseña ha sido restablecida con exito, puede ingresar a nuestro sistema.');
                            include_once('views/login/index.php');
                        }else {
                            $sistema->alert('warning', 'bi bi-exclamation-circle-fill', 'SURGIO UN PROBLEMA', 'Contacta a soporte tecnico o vuelve a iniciar el proceso especificando su correo electronico.');
                            include_once('views/login/forgot.php');
                        }
                    }else {
                        $sistema->alert('danger', 'bi bi-exclamation-circle-fill', 'TOKEN EXPIRADO', 'El token ha expirado, intentelo de nuevo.');
                        include('views/login/index.php');
                    }
                }else {
                    $sistema->alert('danger', 'bi bi-exclamation-circle-fill', 'URL INCORRECTA', 'URL no puede ser completada como la requirio.');
                    include('views/login/index.php');
                }
            break;
            case 'register':
                if(isset($_POST['enviar'])){
                    $data=$_POST['data'];
                    $cantidad1 = $usuario->newRegister($data);
                    if ($cantidad1) {
                        $idUsuarioNew = $usuario->getId($data);
                        $cantidad2 = $usuario->asignarRol($idUsuarioNew, 4);
                        if ($cantidad2) {
                            $cantidad3 = $cliente->newRegister($data, $idUsuarioNew);
                            if ($cantidad3) {
                                $cliente->alert('success', 'bi bi-check-circle-fill', 'REGISTRO COMPLETADO', 'El registro se completo correctamente, ahora puedes ingresar a nuestro sistema.');
                                include('views/login/index.php');
                            } else {
                                $cliente->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Algo salio mal, intenta de nuevo.');
                                include('views/login/index.php');
                            }
                        }else {
                            $cliente->alert('danger', 'bi bi-exclamation-circle-fill', 'Error', 'Hubo un error, intenta de nuevo.');
                            include('views/login/register.php');
                        }
                    } else {
                        $cliente->alert('warning', 'bi bi-exclamation-circle-fill', 'Correo registrado', 'El correo ya se encuentra registrado, intenta con otro.');
                        include('views/login/register.php');
                    }
                }else {
                    include('views/login/register.php');   
                }
            break;
            case 'login':
            default:
                if(isset($_POST['enviar'])){
                    $data=$_POST;
                    if($sistema->login($data['correo'],$data['contrasena'])){
                        if (in_array('Administrador', $_SESSION['roles'])) {
                            header("Location: index_admin.php");
                        }else if (in_array('Gerente', $_SESSION['roles'])) {
                            header("Location: index_gerente.php");
                        }else if (in_array('Dependiente', $_SESSION['roles'])) {
                            header("Location: index_dependiente.php");
                        }
                        else if (in_array('Usuario', $_SESSION['roles'])) {
                            header("Location: index_usuario.php");
                        }
                        
                    }
                }
                include('views/login/index.php');
            break;        
        }
    ?>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>