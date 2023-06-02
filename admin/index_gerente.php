<?php include_once(__DIR__."/controllers/sistema.php"); 
      $sistema->validateRol('Gerente');
      require_once (__DIR__."/controllers/calzado.php");
      require_once (__DIR__."/controllers/ropa.php");
      require_once (__DIR__."/controllers/juguete.php"); ?>
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
      .card-footer {
        display: flex;
        justify-content: flex-end;
        margin-top: 10px;
      }
    </style> 
  </head>
  <body>
    <?php
        include_once('views/menu_gerente.php'); 
    ?>
    <div class="row my-container">
      <div class="col-md-4">
        <div class="panel panel-box clearfix" style="display: flex; align-items: center;">
          <div class="panel-icon pull-left bg-green">
            <i class="bi bi-currency-dollar"></i>
          </div>
          <div class="panel-value pull-right" >
            <h2 class="margin-top">$ <?php echo ($juguete->totalVentasJuguete()); ?></h2>
            <p class="text-muted">TOTAL VENTAS JUGUETES DE ESTE MES</p>
          </div>
        </div>
        <div class="card-footer">
          <a class="btn btn-dark" href="reporte.php?action=ventasJuguete" target="_blank">PDF ventas por mes del juguete</a>
        </div>
        <div class="card-footer">
          <a class="btn btn-dark" href="excel.php?action=ventasJuguete" target="_blank">Excel ventas por mes del juguete</a>
        </div>
      </div>
      <div class="col-md-4">
        <div class="panel panel-box clearfix" style="display: flex; align-items: center;">
          <div class="panel-icon pull-left bg-red">
            <i class="bi bi-currency-dollar"></i>
          </div>
          <div class="panel-value pull-right">
            <h2 class="margin-top">$ <?php echo ($ropa->totalVentasRopa()); ?></h2>
            <p class="text-muted">TOTAL VENTAS ROPA DE ESTE MES</p>
          </div>
        </div>
        <div class="card-footer">
          <a class="btn btn-dark" href="reporte.php?action=ventasRopa" target="_blank">PDF ventas por mes de ropa</a>
        </div>
        <div class="card-footer">
          <a class="btn btn-dark" href="excel.php?action=ventasRopa" target="_blank">Excel ventas por mes de ropa</a>
        </div>
      </div>
      <div class="col-md-4">
        <div class="panel panel-box clearfix" style="display: flex; align-items: center;">
          <div class="panel-icon pull-left bg-blue">
            <i class="bi bi-currency-dollar"></i>
          </div>
          <div class="panel-value pull-right">
            <h2 class="margin-top">$ <?php echo ($calzado->totalVentasCalzado()); ?></h2>
            <p class="text-muted">TOTAL VENTAS CALZADO DE ESTE MES</p>
          </div>
        </div>
        <div class="card-footer">
          <a class="btn btn-dark" href="reporte.php?action=ventasCalzado" target="_blank">PDF ventas por mes del calzado</a>
        </div>
        <div class="card-footer">
          <a class="btn btn-dark" href="excel.php?action=ventasCalzado" target="_blank">Excel ventas por mes del calzado</a>
        </div>
      </div>
    </div>
    <br>
    <br>
    <br>
    <br>
    <div class="row my-container">
      <div class="col-md-4">
        <div class="panel panel-default">
          <div class="panel-heading">
            <strong>
              <span class="glyphicon glyphicon-th"></span>
              <span>Proveedores con mas ventas en juguete</span>
            </strong>
          </div>
          <div class="panel-body">
            <table class="table table-striped table-bordered table-condensed">
              <thead>
              <tr>
                <th>Proveedor</th>
                <th>Cantidad vendida</th>
                <th>Total vendido</th>
              <tr>
              </thead>
              <tbody>
                <?php $data = $juguete->proveedoresJuguete(); foreach($data as $key => $proveedorJuguete): ?>
                  <tr>
                    <td><?php echo $proveedorJuguete['proveedor']; ?></td>
                    <td><?php echo $proveedorJuguete['cantidad_vendida']; ?></td>
                    <td><?php echo $proveedorJuguete['total_vendido']; ?></td>
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
              <span>Proveedores con mas ventas en ropa</span>
            </strong>
          </div>
          <div class="panel-body">
            <table class="table table-striped table-bordered table-condensed">
              <thead>
              <tr>
                <th>Proveedor</th>
                <th>Cantidad vendida</th>
                <th>Total vendido</th>
              <tr>
              </thead>
              <tbody>
                <?php $data = $ropa->proveedoresRopa(); foreach($data as $key => $proveedorRopa): ?>
                  <tr>
                    <td><?php echo $proveedorRopa['proveedor']; ?></td>
                    <td><?php echo $proveedorRopa['cantidad_vendida']; ?></td>
                    <td><?php echo $proveedorRopa['total_vendido']; ?></td>
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
              <span>Proveedores con mas ventas en calzado</span>
            </strong>
          </div>
          <div class="panel-body">
            <table class="table table-striped table-bordered table-condensed">
              <thead>
              <tr>
                <th>Proveedor</th>
                <th>Cantidad vendida</th>
                <th>Total vendido</th>
              <tr>
              </thead>
              <tbody>
                <?php $data = $calzado->proveedoresCalzado(); foreach($data as $key => $proveedorCalzado): ?>
                  <tr>
                    <td><?php echo $proveedorCalzado['proveedor']; ?></td>
                    <td><?php echo $proveedorCalzado['cantidad_vendida']; ?></td>
                    <td><?php echo $proveedorCalzado['total_vendido']; ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
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
              <span>Clientes con mas compras en juguete</span>
            </strong>
          </div>
          <div class="panel-body">
            <table class="table table-striped table-bordered table-condensed">
              <thead>
              <tr>
                <th>Cliente</th>
                <th>Cantidad vendida</th>
                <th>Total vendido</th>
              <tr>
              </thead>
              <tbody>
                <?php $data = $juguete->clientesJuguete(); foreach($data as $key => $clienteJuguete): ?>
                  <tr>
                    <td><?php echo $clienteJuguete['cliente']; ?></td>
                    <td><?php echo $clienteJuguete['cantidad']; ?></td>
                    <td><?php echo $clienteJuguete['total_comprado']; ?></td>
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
              <span>Clientes con mas compras en ropa</span>
            </strong>
          </div>
          <div class="panel-body">
            <table class="table table-striped table-bordered table-condensed">
              <thead>
              <tr>
                <th>Cliente</th>
                <th>Cantidad vendida</th>
                <th>Total vendido</th>
              <tr>
              </thead>
              <tbody>
                <?php $data = $ropa->clientesRopa(); foreach($data as $key => $clienteRopa): ?>
                  <tr>
                    <td><?php echo $clienteRopa['cliente']; ?></td>
                    <td><?php echo $clienteRopa['cantidad']; ?></td>
                    <td><?php echo $clienteRopa['total_comprado']; ?></td>
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
              <span>Clientes con mas compras en calzado</span>
            </strong>
          </div>
          <div class="panel-body">
            <table class="table table-striped table-bordered table-condensed">
              <thead>
              <tr>
                <th>Proveedor</th>
                <th>Cantidad vendida</th>
                <th>Total vendido</th>
              <tr>
              </thead>
              <tbody>
                <?php $data = $calzado->proveedoresCalzado(); foreach($data as $key => $proveedorCalzado): ?>
                  <tr>
                    <td><?php echo $proveedorCalzado['proveedor']; ?></td>
                    <td><?php echo $proveedorCalzado['cantidad_vendida']; ?></td>
                    <td><?php echo $proveedorCalzado['total_vendido']; ?></td>
                  </tr>
                <?php endforeach; ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ENjdO4Dr2bkBIFxQpeoTz1HIcje39Wm4jDKdf19U8gI4ddQ3GYNS7NTKfAdVQSZe" crossorigin="anonymous"></script>
  </body>
</html>
