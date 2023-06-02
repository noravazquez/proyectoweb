<?php include_once(__DIR__."/controllers/sistema.php"); 
      require_once (__DIR__."/controllers/usuario.php");
      require_once (__DIR__."/controllers/proveedor.php");
      require_once (__DIR__."/controllers/pedido.php");
      require_once (__DIR__."/controllers/ropa.php");
      require_once (__DIR__."/controllers/calzado.php");
      require_once (__DIR__."/controllers/juguete.php");
      $sistema->validateRol('Administrador'); ?>
<!doctype html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>HOME</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KK94CHFLLe+nY2dmCWGMq91rCGa5gtU4mk92HdvYe+M/SXH301p5ILy+dN9+nJOZ" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
    <link rel="stylesheet" href="css/style.css">
    <style>
      .bg-green{
        background-color: #A3C86D;
      }
      .bg-blue{
        background-color: #7ACBEE;
      }
      .bg-yellow{
        background-color: #FDD761;
      }
      .bg-red{
        background-color: #FF7857;
      }
      .panel-default >.panel-heading{
        background-color: #f5f5f5;
        border-bottom: 2px solid #3498DB;
        font-size: 15px;
        text-transform: uppercase;
        letter-spacing: .5px;
        padding: 15px;
      }.panel-box{
        width: 100%;
        height: 100%;
        text-align: center;
        border: none;
      }.panel-value{
        width: 60%;
      }.panel-icon{
        padding: 30px;
        width: 40%;
        border-radius: 0;
      }.panel-icon{
        -webkit-border-radius: 3px 0 0 3px;
        -moz-border-radius: 3px 0 0 3px;
        border-radius: 3px 0 0 3px;
      }.panel-value{
        -webkit-border-radius: 0 3px 3px 0;
        -moz-border-radius: 0 3px 3px 0;
        border-radius: 0 3px 3px 0;
      }.panel-value h2{
        margin-top: 30px;
      }
      .panel-icon i{
        line-height:65px;
        font-size: 40px;
        color: #fff;
      }
      .my-container {
        margin: 15px; /* Ajusta el valor según tus necesidades */
      }
    </style> 
  </head>
  <body>
    <?php
        include_once('views/menu_admin.php'); 
    ?>
    <br>
    <br>
    <div class="row my-container">
      <div class="col-md-4">
        <div class="panel panel-box clearfix" style="display: flex; align-items: center;">
          <div class="panel-icon pull-left bg-green">
            <i class="bi bi-people-fill"></i>
          </div>
          <div class="panel-value pull-right" >
            <h2 class="margin-top"><?php echo ($usuario->countUsers()); ?></h2>
            <p class="text-muted">Usuarios</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="panel panel-box clearfix" style="display: flex; align-items: center;">
          <div class="panel-icon pull-left bg-red">
            <i class="bi bi-people-fill"></i>
          </div>
          <div class="panel-value pull-right">
            <h2 class="margin-top"><?php echo ($proveedor->countProveedor()); ?></h2>
            <p class="text-muted">Proveedores</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="panel panel-box clearfix" style="display: flex; align-items: center;">
          <div class="panel-icon pull-left bg-blue">
            <i class="bi bi-currency-dollar"></i>
          </div>
          <div class="panel-value pull-right">
            <h2 class="margin-top"><?php echo ($pedido->countPedido()); ?></h2>
            <p class="text-muted">Pedidos</p>
          </div>
        </div>
      </div>
    </div>
    <br>
    <div class="row my-container">
      <div class="col-md-4">
        <div class="panel panel-box clearfix" style="display: flex; align-items: center;">
          <div class="panel-icon pull-left bg-green">
            <i class="bi bi-cart-fill"></i>
          </div>
          <div class="panel-value pull-right" >
            <h2 class="margin-top"><?php echo ($ropa->countRopa()); ?></h2>
            <p class="text-muted">Ropa</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="panel panel-box clearfix" style="display: flex; align-items: center;">
          <div class="panel-icon pull-left bg-red">
            <i class="bi bi-cart-fill"></i>
          </div>
          <div class="panel-value pull-right">
            <h2 class="margin-top"><?php echo ($calzado->countCalzado()); ?></h2>
            <p class="text-muted">Calzado</p>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="panel panel-box clearfix" style="display: flex; align-items: center;">
          <div class="panel-icon pull-left bg-blue">
            <i class="bi bi-cart-fill"></i>
          </div>
          <div class="panel-value pull-right">
            <h2 class="margin-top"><?php echo ($juguete->countJuguete()); ?></h2>
            <p class="text-muted">Juguete</p>
          </div>
        </div>
      </div>
    </div>
    <div class="row my-container">
      <div class="col-md-4">
        <div class="panel panel-default">
          <div class="panel-heading">
            <strong>
              <span class="glyphicon glyphicon-th"></span>
              <span>Prendas más vendidas</span>
            </strong>
          </div>
          <div class="panel-body">
            <table class="table table-striped table-bordered table-condensed">
              <thead>
              <tr>
                <th>Prenda</th>
                <th>Total vendido</th>
              <tr>
              </thead>
              <tbody>
                <?php $data = $ropa->ropaVendida(); foreach($data as $key => $ropaMasVendida): ?>
                  <tr>
                    <td><?php echo $ropaMasVendida['nombre_ropa']; ?></td>
                    <td><?php echo $ropaMasVendida['cantidad_vendida']; ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="panel panel-default">
          <div class="panel-heading">
            <strong>
              <span class="glyphicon glyphicon-th"></span>
              <span>Juguetes más vendidos</span>
            </strong>
          </div>
          <div class="panel-body">
            <table class="table table-striped table-bordered table-condensed">
              <thead>
              <tr>
                <th>Juguete</th>
                <th>Total vendido</th>
              <tr>
              </thead>
              <tbody>
                <?php $data = $juguete->jugueteVendido(); foreach($data as $key => $jugueteMasVendido): ?>
                  <tr>
                    <td><?php echo $jugueteMasVendido['nombre_juguete']; ?></td>
                    <td><?php echo $jugueteMasVendido['cantidad_vendida']; ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
      <div class="col-md-4">
        <div class="panel panel-default">
          <div class="panel-heading">
            <strong>
              <span class="glyphicon glyphicon-th"></span>
              <span>Calzado más vendido</span>
            </strong>
          </div>
          <div class="panel-body">
            <table class="table table-striped table-bordered table-condensed">
              <thead>
              <tr>
                <th>Calzado</th>
                <th>Total vendido</th>
              <tr>
              </thead>
              <tbody>
                <?php $data = $calzado->calzadoVendido(); foreach($data as $key => $calzadoMasVendido): ?>
                  <tr>
                    <td><?php echo $calzadoMasVendido['nombre_calzado']; ?></td>
                    <td><?php echo $calzadoMasVendido['cantidad_vendida']; ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>